<?php namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model
{
    protected $table      = 'estado';      // <-- Correct: 'estado' (singular)
    protected $primaryKey = 'idestado';    // <-- Correct: 'idestado' (from your schema)

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;    // You don't have a 'deleted_at' column

    // Only include the fields that exist in your 'estado' table
    protected $allowedFields = [
        'estado' // <-- Correct: 'estado' (from your schema)
    ];

    // Disable timestamps if you don't have 'fecha_creacion'/'fecha_modificacion'
    protected $useTimestamps = false;
    // Remove these lines if useTimestamps is false:
    // protected $createdField  = 'fecha_creacion';
    // protected $updatedField  = 'fecha_modificacion';

    protected $validationRules    = [
        // Validate the 'estado' column, using 'idestado' as the unique key
        'estado' => 'required|min_length[2]|max_length[100]|is_unique[estado.estado,idestado,{idestado}]',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}