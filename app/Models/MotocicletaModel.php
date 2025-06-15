<?php namespace App\Models;

use CodeIgniter\Model;

class MotocicletaModel extends Model
{
    protected $table      = 'motos';
    protected $primaryKey = 'placa';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'placa',         // La placa es requerida y clave primaria
        'idestado',
        'idcliente',     // Si es nulo, no hace falta en el formulario
        'chasis',
        'Motor',         // Lo que antes era 'kilometraje' o similar        
        'idmarca',       // Esto es la 'marca' de tu formulario
        'año',           // Esto es 'anio' de tu formulario
        'modelo',
        'color',
        'fecha_entrega',
        'fecha_renovacion',
        'Envio',
        'taller',
        'iddepartamento',
        'idagencia',
        'renta_sinIva',
        'renta_conIva',
        'naf',
        'creado_por',     
        'modificado_por'  
    ];

    // Si tu tabla NO tiene columnas 'fecha_registro' y 'fecha_actualizacion',
    // entonces debes DESACTIVAR los timestamps automáticos.
    protected $useTimestamps = false; // ¡CAMBIO AQUÍ!
    // protected $createdField  = 'fecha_registro'; // Ya no son necesarios si useTimestamps es false
    // protected $updatedField  = 'fecha_actualizacion'; // Ya no son necesarios si useTimestamps es false
    protected $deletedField  = 'deleted_at'; // Si no usas soft deletes, esta línea no es necesaria.

    protected $validationRules = [
        'placa'       => 'required|max_length[15]|is_unique[motos.placa]', // Asegura que la placa sea única
        'idestado'    => 'required|integer',
        'idmarca'     => 'required|integer', // 'marca' de tu formulario ahora es 'idmarca'
        'modelo'      => 'required|min_length[2]|max_length[50]',
        'año'         => 'required|integer|exact_length[4]', // 'anio' de tu formulario ahora es 'año'
        'Motor'       => 'required|max_length[50]', // Asumiendo que 'Motor' es tu campo para kilometraje/tipo de motor
        'creado_por'  => 'required|integer', 
        'idagencia'   => 'permit_empty|integer',// ¡CAMBIO AQUÍ!
        // Añade validación para otros campos si son obligatorios en tu DB o en tu lógica de negocio
        // 'chasis'      => 'permit_empty|max_length[50]', // Ejemplo para campos que pueden estar vacíos
        // 'idcliente'   => 'permit_empty|integer',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}