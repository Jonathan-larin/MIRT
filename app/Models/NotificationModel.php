<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'title', 'message', 'type', 'related_table', 'related_id', 'is_read', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id' => 'required|integer',
        'title' => 'required|max_length[255]',
        'message' => 'required',
        'type' => 'required|in_list[motorcycle,service,rental]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Create notification for relevant users
     */
    public function createNotificationForActivity($activityData)
    {
        $tableName = $activityData['table_name'];
        $action = $activityData['action'];
        $recordId = $activityData['record_id'];
        $userId = $activityData['user_id'];

        // Define which activities should trigger notifications
        $notifiableActivities = [
            'motos' => [
                'actions' => ['INSERT', 'UPDATE', 'DELETE'],
                'type' => 'motorcycle'
            ],
            'servicios' => [
                'actions' => ['INSERT', 'UPDATE'],
                'type' => 'service'
            ],
            'motos' => [ // For rental changes (when motorcycle status changes to/from rented)
                'actions' => ['UPDATE'],
                'type' => 'rental',
                'condition' => function($oldValues, $newValues) {
                    // Check if idcliente or status changed (indicating rental start/end)
                    $oldClient = $oldValues['idcliente'] ?? null;
                    $newClient = $newValues['idcliente'] ?? null;
                    return $oldClient !== $newClient;
                }
            ]
        ];

        if (!isset($notifiableActivities[$tableName])) {
            return false;
        }

        $activityConfig = $notifiableActivities[$tableName];

        if (!in_array($action, $activityConfig['actions'])) {
            return false;
        }

        // Check conditional logic if provided
        if (isset($activityConfig['condition'])) {
            $oldValues = json_decode($activityData['old_values'] ?? '[]', true);
            $newValues = json_decode($activityData['new_values'] ?? '[]', true);

            if (!$activityConfig['condition']($oldValues, $newValues)) {
                return false;
            }
        }

        // Get users to notify (Operario and Jefatura roles)
        $usuarioModel = new UsuarioModel();
        $targetUsers = $usuarioModel->whereIn('rol', ['Operario', 'Jefatura'])
                                   ->where('estado', 1)
                                   ->findAll();

        if (empty($targetUsers)) {
            return false;
        }

        // Create notification message
        $notificationData = $this->generateNotificationData($tableName, $action, $recordId, $activityConfig['type'], $newValues ?? []);

        $createdNotifications = 0;
        foreach ($targetUsers as $targetUser) {
            // Don't notify the user who made the change
            if ($targetUser['idUsuario'] == $userId) {
                continue;
            }

            $notificationData['user_id'] = $targetUser['idUsuario'];
            $this->insert($notificationData);
            $createdNotifications++;
        }

        return $createdNotifications > 0;
    }

    /**
     * Generate notification data based on activity
     */
    private function generateNotificationData($table, $action, $recordId, $type, $newValues)
    {
        switch ($table) {
            case 'motos':
                $title = $this->getMotorcycleNotificationTitle($action, $type);
                $message = $this->getMotorcycleNotificationMessage($action, $recordId, $newValues, $type);
                break;

            case 'servicios':
                $title = $this->getServiceNotificationTitle($action);
                $message = $this->getServiceNotificationMessage($action, $recordId, $newValues);
                break;

            default:
                $title = 'Actividad del Sistema';
                $message = "Se ha realizado una actividad en la tabla {$table}";
        }

        return [
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'related_table' => $table,
            'related_id' => $recordId,
            'is_read' => false
        ];
    }

    /**
     * Get motorcycle notification title
     */
    private function getMotorcycleNotificationTitle($action, $type)
    {
        if ($type === 'rental') {
            return 'Cambio en Estado de Renta';
        }

        switch ($action) {
            case 'INSERT':
                return 'Nueva Motocicleta Agregada';
            case 'UPDATE':
                return 'Motocicleta Modificada';
            case 'DELETE':
                return 'Motocicleta Eliminada';
            default:
                return 'Actividad en Motocicleta';
        }
    }

    /**
     * Get motorcycle notification message
     */
    private function getMotorcycleNotificationMessage($action, $recordId, $newValues, $type)
    {
        $motorcycleInfo = "Placa: {$recordId}";

        if ($type === 'rental') {
            $clienteModel = new ClienteModel();
            $cliente = $clienteModel->find($newValues['idcliente'] ?? null);

            if ($cliente) {
                return "La motocicleta {$recordId} ha sido " .
                       ($newValues['idcliente'] ? "rentada al cliente {$cliente['Cliente']}" : "devuelta");
            }
            return "Cambio en el estado de renta de la motocicleta {$recordId}";
        }

        switch ($action) {
            case 'INSERT':
                return "Se ha agregado una nueva motocicleta. {$motorcycleInfo}";
            case 'UPDATE':
                return "Se han realizado cambios en la motocicleta. {$motorcycleInfo}";
            case 'DELETE':
                return "Se ha eliminado la motocicleta. {$motorcycleInfo}";
            default:
                return "Actividad registrada en la motocicleta. {$motorcycleInfo}";
        }
    }

    /**
     * Get service notification title
     */
    private function getServiceNotificationTitle($action)
    {
        switch ($action) {
            case 'INSERT':
                return 'Nuevo Servicio Creado';
            case 'UPDATE':
                return 'Servicio Modificado';
            default:
                return 'Actividad en Servicio';
        }
    }

    /**
     * Get service notification message
     */
    private function getServiceNotificationMessage($action, $recordId, $newValues)
    {
        $serviceInfo = "ID de Servicio: {$recordId}";
        $placa = $newValues['placa_motocicleta'] ?? 'Desconocida';
        $estado = $newValues['estado_servicio'] ?? 'Desconocido';

        switch ($action) {
            case 'INSERT':
                return "Se ha creado un nuevo servicio para la motocicleta {$placa}. Estado: {$estado}. {$serviceInfo}";
            case 'UPDATE':
                $message = "Se han realizado cambios en el servicio de la motocicleta {$placa}. {$serviceInfo}";
                if (isset($newValues['estado_servicio'])) {
                    $message .= " Nuevo estado: {$estado}";
                }
                return $message;
            default:
                return "Actividad registrada en el servicio. {$serviceInfo}";
        }
    }

    /**
     * Get unread notifications for user
     */
    public function getUnreadNotifications($userId, $limit = 50)
    {
        return $this->where('user_id', $userId)
                    ->where('is_read', false)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Get notifications count for user
     */
    public function getNotificationsCount($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('is_read', false)
                    ->countAllResults();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId, $userId)
    {
        return $this->where('id', $notificationId)
                    ->where('user_id', $userId)
                    ->update(['is_read' => true]);
    }

    /**
     * Mark all notifications as read for user
     */
    public function markAllAsRead($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
    }

    /**
     * Get recent notifications for user (both read and unread)
     */
    public function getRecentNotifications($userId, $limit = 20)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
