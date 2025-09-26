<?php namespace App\Models;

use CodeIgniter\Model;
use App\Traits\ActivityLoggable;

class MotocicletaModel extends Model
{
    use ActivityLoggable;

    public function __construct()
    {
        parent::__construct();
        $this->initializeActivityLog();
    }

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
        'Motor',         // Lo que antes era 'kilometraje'        
        'idmarca',       // Esto es la 'marca' en el formulario
        'año',           // Esto es 'anio' en el formulario
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
    
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'placa'       => 'required|max_length[15]|is_unique[motos.placa]', // Asegura que la placa sea única
        'idestado'    => 'required|integer',
        'idmarca'     => 'required|integer', // 'marca' en formulario ahora es 'idmarca'
        'modelo'      => 'required|min_length[2]|max_length[50]',
        'año'         => 'required|integer|exact_length[4]', // 'anio' de tu formulario ahora es 'año'
        'Motor'       => 'required|max_length[50]', // Asumiendo que 'Motor' es campo para kilometraje/tipo de motor
        'creado_por'  => 'required|integer', 
        'idagencia'   => 'permit_empty|integer',
        // Añadir validación para otros campos si son obligatorios en DB        
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
