<?php namespace App\Models;

use CodeIgniter\Model;

class AgenciaModel extends Model
{
    protected $table      = 'agencia';    
    protected $primaryKey = 'idagencia';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // Estos son los campos que se pueden insertar o actualizar
    protected $allowedFields = [
        'agencia',
        'dirrecion',
        'celular'
    ];

    protected $useTimestamps = false;
    
    //Reglas de validación para los campos del formulario

    protected $validationRules    = [
        'agencia'   => 'required|min_length[3]|max_length[100]|is_unique[agencia.agencia,idagencia,{idagencia}]',
        'dirrecion' => 'permit_empty|max_length[250]',
        'celular'   => 'permit_empty|max_length[9]|regex_match[/^[0-9]{8,9}$/]', // Basic phone number regex
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}