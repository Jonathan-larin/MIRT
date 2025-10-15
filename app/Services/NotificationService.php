<?php

namespace App\Services;

use App\Models\NotificationModel;
use App\Models\ActivityLogModel;
use App\Models\UsuarioModel;

class NotificationService
{
    protected $notificationModel;
    protected $activityLogModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->activityLogModel = new ActivityLogModel();
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Process new activity logs and create notifications
     */
    public function processActivityLogs()
    {
        // Get recent activity logs that haven't been processed for notifications
        $recentActivities = $this->activityLogModel->getRecentActivities(50);

        $processedCount = 0;

        foreach ($recentActivities as $activity) {
            // Check if this activity should trigger a notification
            if ($this->shouldCreateNotification($activity)) {
                $result = $this->notificationModel->createNotificationForActivity($activity);
                if ($result) {
                    $processedCount++;
                }
            }
        }

        return $processedCount;
    }

    /**
     * Determine if an activity should trigger a notification
     */
    private function shouldCreateNotification($activity)
    {
        $tableName = $activity['table_name'];
        $action = $activity['action'];

        // Define which activities should trigger notifications
        $notifiableActivities = [
            'motos' => [
                'actions' => ['INSERT', 'UPDATE', 'DELETE'],
                'conditions' => [
                    'UPDATE' => function($activity) {
                        // Only notify on rental changes for UPDATE
                        $oldValues = json_decode($activity['old_values'] ?? '[]', true);
                        $newValues = json_decode($activity['new_values'] ?? '[]', true);
                        return isset($oldValues['idcliente']) && isset($newValues['idcliente']) &&
                               $oldValues['idcliente'] !== $newValues['idcliente'];
                    }
                ]
            ],
            'servicios' => [
                'actions' => ['INSERT', 'UPDATE']
            ]
        ];

        if (!isset($notifiableActivities[$tableName])) {
            return false;
        }

        $config = $notifiableActivities[$tableName];

        if (!in_array($action, $config['actions'])) {
            return false;
        }

        // Check conditions if specified
        if (isset($config['conditions']) && isset($config['conditions'][$action])) {
            return $config['conditions'][$action]($activity);
        }

        return true;
    }

    /**
     * Get notifications for a specific user
     */
    public function getUserNotifications($userId, $limit = 50, $includeRead = false)
    {
        if ($includeRead) {
            return $this->notificationModel->getRecentNotifications($userId, $limit);
        } else {
            return $this->notificationModel->getUnreadNotifications($userId, $limit);
        }
    }

    /**
     * Get notification count for a user
     */
    public function getUserNotificationCount($userId)
    {
        return $this->notificationModel->getNotificationsCount($userId);
    }

    /**
     * Mark notification as read
     */
    public function markNotificationAsRead($notificationId, $userId)
    {
        return $this->notificationModel->markAsRead($notificationId, $userId);
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllNotificationsAsRead($userId)
    {
        return $this->notificationModel->markAllAsRead($userId);
    }

    /**
     * Get target users for notifications (Operario and Jefatura roles)
     */
    public function getTargetUsers()
    {
        return $this->usuarioModel->whereIn('rol', ['Operario', 'Jefatura'])
                                 ->where('estado', 1)
                                 ->findAll();
    }

    /**
     * Create manual notification (for future use)
     */
    public function createManualNotification($title, $message, $type, $userIds = null, $relatedTable = null, $relatedId = null)
    {
        if ($userIds === null) {
            $targetUsers = $this->getTargetUsers();
            $userIds = array_column($targetUsers, 'idUsuario');
        }

        $createdCount = 0;
        foreach ((array)$userIds as $userId) {
            $data = [
                'user_id' => $userId,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'related_table' => $relatedTable,
                'related_id' => $relatedId,
                'is_read' => false
            ];

            if ($this->notificationModel->insert($data)) {
                $createdCount++;
            }
        }

        return $createdCount;
    }
}
