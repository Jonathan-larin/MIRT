<?php namespace App\Models;

use CodeIgniter\Model;

class RentaModel extends Model
{
    protected $table = 'motos';
    protected $primaryKey = 'placa';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'placa',
        'idestado',
        'idcliente',
        'chasis',
        'Motor',
        'idmarca',
        'año',
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
        'modificado_por'
    ];

    protected $useTimestamps = false;
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'placa' => 'required|max_length[15]',
        'idcliente' => 'required|integer',
        'fecha_entrega' => 'required|valid_date',
        'fecha_renovacion' => 'required|valid_date',
        'renta_sinIva' => 'required|decimal',
        'renta_conIva' => 'required|decimal',
        'modificado_por' => 'required|integer'
    ];

    protected $validationMessages = [
        'placa' => [
            'required' => 'La placa es requerida.',
            'max_length' => 'La placa no puede exceder 15 caracteres.'
        ],
        'idcliente' => [
            'required' => 'El cliente es requerido.',
            'integer' => 'ID de cliente inválido.'
        ],
        'fecha_entrega' => [
            'required' => 'La fecha de entrega es requerida.',
            'valid_date' => 'Fecha de entrega inválida.'
        ],
        'fecha_renovacion' => [
            'required' => 'La fecha de renovación es requerida.',
            'valid_date' => 'Fecha de renovación inválida.'
        ],
        'renta_sinIva' => [
            'required' => 'La renta sin IVA es requerida.',
            'decimal' => 'Valor inválido para renta sin IVA.'
        ],
        'renta_conIva' => [
            'required' => 'La renta con IVA es requerida.',
            'decimal' => 'Valor inválido para renta con IVA.'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Get all active rentals (motorcycles with clients assigned)
     */
    public function getActiveRentals()
    {
        return $this->select('motos.*, cliente.Cliente as nombre_cliente, marca.marca as nombre_marca, estado.estado as nombre_estado, agencia.agencia as nombre_agencia')
                    ->join('cliente', 'cliente.idCliente = motos.idcliente', 'left')
                    ->join('marca', 'marca.idmarca = motos.idmarca', 'left')
                    ->join('estado', 'estado.idestado = motos.idestado', 'left')
                    ->join('agencia', 'agencia.idagencia = motos.idagencia', 'left')
                    ->where('motos.idcliente IS NOT NULL')
                    ->where('motos.idestado', 3) // Estado "Alquilada"
                    ->findAll();
    }

    /**
     * Get available motorcycles for rental
     */
    public function getAvailableMotorcycles()
    {
        return $this->select('motos.*, marca.marca as nombre_marca, estado.estado as nombre_estado')
                    ->join('marca', 'marca.idmarca = motos.idmarca', 'left')
                    ->join('estado', 'estado.idestado = motos.idestado', 'left')
                    ->where('motos.idestado', 1) // Estado "Disponible"
                    ->findAll();
    }

    /**
     * Get rental details by placa
     */
    public function getRentalDetails($placa)
    {
        return $this->select('motos.*, cliente.Cliente as nombre_cliente, marca.marca as nombre_marca, estado.estado as nombre_estado, agencia.agencia as nombre_agencia')
                    ->join('cliente', 'cliente.idCliente = motos.idcliente', 'left')
                    ->join('marca', 'marca.idmarca = motos.idmarca', 'left')
                    ->join('estado', 'estado.idestado = motos.idestado', 'left')
                    ->join('agencia', 'agencia.idagencia = motos.idagencia', 'left')
                    ->find($placa);
    }

    /**
     * Create new rental
     */
    public function createRental($data)
    {
        // Set status to "Alquilada" (idestado = 3)
        $data['idestado'] = 3;

        // Calculate dates if needed
        if (isset($data['fecha_entrega']) && !isset($data['fecha_renovacion'])) {
            // Default to 30 days from delivery date
            $deliveryDate = new \DateTime($data['fecha_entrega']);
            $renewalDate = $deliveryDate->modify('+30 days');
            $data['fecha_renovacion'] = $renewalDate->format('Y-m-d');
        }

        return $this->update($data['placa'], $data);
    }

    /**
     * End rental (return motorcycle to available)
     */
    public function endRental($placa, $modifiedBy)
    {
        $data = [
            'idcliente' => null,
            'idestado' => 1, // Estado "Disponible"
            'fecha_entrega' => null,
            'fecha_renovacion' => null,
            'renta_sinIva' => null,
            'renta_conIva' => null,
            'modificado_por' => $modifiedBy
        ];

        return $this->update($placa, $data);
    }

    /**
     * Update rental information
     */
    public function updateRental($placa, $data)
    {
        // Ensure status remains "Alquilada" if still rented
        if (isset($data['idcliente']) && $data['idcliente'] !== null) {
            $data['idestado'] = 3;
        }

        return $this->update($placa, $data);
    }

    /**
     * Get expiring leases within specified days
     */
    public function getExpiringLeases($daysAhead = 7)
    {
        $currentDate = date('Y-m-d');
        $futureDate = date('Y-m-d', strtotime("+{$daysAhead} days"));

        return $this->select('motos.*, cliente.Cliente as nombre_cliente, marca.marca as nombre_marca, estado.estado as nombre_estado, agencia.agencia as nombre_agencia')
                    ->join('cliente', 'cliente.idCliente = motos.idcliente', 'left')
                    ->join('marca', 'marca.idmarca = motos.idmarca', 'left')
                    ->join('estado', 'estado.idestado = motos.idestado', 'left')
                    ->join('agencia', 'agencia.idagencia = motos.idagencia', 'left')
                    ->where('motos.idcliente IS NOT NULL')
                    ->where('motos.idestado', 3) // Estado "Alquilada"
                    ->where('motos.fecha_renovacion >=', $currentDate)
                    ->where('motos.fecha_renovacion <=', $futureDate)
                    ->orderBy('motos.fecha_renovacion', 'ASC')
                    ->findAll();
    }

    /**
     * Get count of expiring leases within specified days
     */
    public function getExpiringLeasesCount($daysAhead = 7)
    {
        $currentDate = date('Y-m-d');
        $futureDate = date('Y-m-d', strtotime("+{$daysAhead} days"));

        return $this->where('idcliente IS NOT NULL')
                    ->where('idestado', 3) // Estado "Alquilada"
                    ->where('fecha_renovacion >=', $currentDate)
                    ->where('fecha_renovacion <=', $futureDate)
                    ->countAllResults();
    }
}
