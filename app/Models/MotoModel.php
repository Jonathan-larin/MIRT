<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class MotoModel extends Model
{
    protected $table = 'motos';
    protected $primaryKey = 'placa';
    protected $allowedFields = [
        'idestado', 'idcliente', 'chasis', 'Motor', 'Sucursal', 'idmarca', 'año',
        'modelo', 'color', 'fecha_entrega', 'fecha_renovacion', 'Envio', 'taller',
        'iddepartamento', 'idagencia', 'renta_sinIva', 'renta_conIva', 'naf',
        'creado_por', 'modificado_por'
    ];

    public function withRelations()
    {
        return $this->db->table($this->table)
        ->select('motos.placa, motos.modelo, marca.marca, cliente.Cliente, estado.estado')
        ->join('marca', 'marca.idmarca = motos.idmarca')
        ->join('cliente', 'cliente.idCliente = motos.idcliente')
        ->join('estado', 'estado.idestado = motos.idestado')
        ->get()
        ->getResultArray();
    }
}
