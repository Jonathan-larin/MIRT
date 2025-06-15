<?php namespace App\Models;

use CodeIgniter\Model;

class AgenciaModel extends Model
{
    protected $table      = 'agencia';          // Matches your table name
    protected $primaryKey = 'idagencia';        // Matches your primary key field

    protected $useAutoIncrement = true;       // idagencia is auto_increment
    protected $returnType     = 'array';      // Return results as arrays
    protected $useSoftDeletes = false;        // No 'deleted_at' column in your schema

    // These are the fields that can be mass-assigned or updated
    protected $allowedFields = [
        'agencia',
        'dirrecion',
        'celular'
    ];

    protected $useTimestamps = false;         // No timestamp columns like created_at/updated_at
    // protected $createdField  = '';          // Not needed if useTimestamps is false
    // protected $updatedField  = '';          // Not needed if useTimestamps is false

    protected $validationRules    = [
        'agencia'   => 'required|min_length[3]|max_length[100]|is_unique[agencia.agencia,idagencia,{idagencia}]',
        'dirrecion' => 'permit_empty|max_length[250]',
        'celular'   => 'permit_empty|max_length[9]|regex_match[/^[0-9]{8,9}$/]', // Basic phone number regex
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}