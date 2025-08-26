<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
    protected $table            = 'servicios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'placa_motocicleta',
        'tipo_servicio',
        'descripcion',
        'estado_servicio',
        'fecha_solicitud',
        'fecha_inicio',
        'fecha_completado',
        'costo_estimado',
        'costo_real',
        'tecnico_responsable',
        'notas',
        'prioridad',
        'kilometraje_actual',
        'creado_por',
        'modificado_por'
    ];

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
    protected $validationRules = [
        'placa_motocicleta' => 'required|max_length[15]',
        'tipo_servicio'     => 'required|max_length[100]',
        'descripcion'       => 'required|min_length[10]',
        'estado_servicio'   => 'required|in_list[pendiente,en_progreso,completado,cancelado]',
        'fecha_solicitud'   => 'required|valid_date',
        'costo_estimado'    => 'permit_empty|decimal',
        'costo_real'        => 'permit_empty|decimal',
        'tecnico_responsable' => 'permit_empty|max_length[100]',
        'prioridad'         => 'required|in_list[baja,media,alta,urgente]',
        'kilometraje_actual' => 'permit_empty|integer',
        'creado_por'        => 'required|integer'
    ];

    protected $validationMessages = [
        'placa_motocicleta' => [
            'required' => 'La placa de la motocicleta es requerida.',
            'max_length' => 'La placa no puede exceder 15 caracteres.'
        ],
        'tipo_servicio' => [
            'required' => 'El tipo de servicio es requerido.',
            'max_length' => 'El tipo de servicio no puede exceder 100 caracteres.'
        ],
        'descripcion' => [
            'required' => 'La descripción del servicio es requerida.',
            'min_length' => 'La descripción debe tener al menos 10 caracteres.'
        ],
        'estado_servicio' => [
            'required' => 'El estado del servicio es requerido.',
            'in_list' => 'El estado debe ser: pendiente, en_progreso, completado o cancelado.'
        ],
        'fecha_solicitud' => [
            'required' => 'La fecha de solicitud es requerida.',
            'valid_date' => 'La fecha de solicitud debe ser una fecha válida.'
        ],
        'prioridad' => [
            'required' => 'La prioridad del servicio es requerida.',
            'in_list' => 'La prioridad debe ser: baja, media, alta o urgente.'
        ],
        'creado_por' => [
            'required' => 'El usuario creador es requerido.',
            'integer' => 'El ID del usuario creador debe ser un número entero.'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Relationships
    public function getWithMotorcycle()
    {
        return $this->select('servicios.*, motos.modelo, marca.marca AS nombre_marca, motos.año, motos.color')
                    ->join('motos', 'motos.placa = servicios.placa_motocicleta')
                    ->join('marca', 'marca.idmarca = motos.idmarca')
                    ->findAll();
    }

    public function getServiceWithMotorcycle($id)
    {
        return $this->select('servicios.*, motos.modelo, marca.marca AS nombre_marca, motos.año, motos.Motor, motos.color')
                    ->join('motos', 'motos.placa = servicios.placa_motocicleta')
                    ->join('marca', 'marca.idmarca = motos.idmarca')
                    ->find($id);
    }
}
