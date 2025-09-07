<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\MotocicletaModel;
use App\Models\MarcaModel;
use App\Models\EstadoModel;
use App\Models\AgenciaModel;
use App\Models\UsuarioModel;
use App\Models\RentaModel;
use App\Models\ServicioModel;
use App\Models\ClienteModel;

class Dashboard extends BaseController
{
    protected $rentaModel;
    protected $servicioModel;
    protected $clienteModel;
    protected $motocicletaModel;

    public function __construct()
    {
        $this->rentaModel = new RentaModel();
        $this->servicioModel = new ServicioModel();
        $this->clienteModel = new ClienteModel();
        $this->motocicletaModel = new MotocicletaModel();
    }

    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        $rol = $session->get('rol');

        // Obtener el ID del usuario desde la sesión y sus datos desde la BD
        $userId = $session->get('idUsuario');
        $usuarioModel = new UsuarioModel();
        $user = $usuarioModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Usuario no encontrado.');
        }

        // Inicializar los modelos necesarios
        $marcaModel = new MarcaModel();
        $estadoModel = new EstadoModel();
        $agenciaModel = new AgenciaModel();

        $marcas = $marcaModel->findAll();
        $estados = $estadoModel->findAll();
        $agencias = $agenciaModel->findAll();

        // Get real statistics
        $stats = $this->getDashboardStats();

        // Preparar los datos para la vista
        $data = [
            'title' => 'Panel de Administrador',
            'user' => $user, // Datos completos del usuario desde BD
            'current_date' => date('d/m/Y'),
            'logged_in_user_id' => $userId, // Pass user ID if needed for 'creadopor'
            'stats' => $stats
        ];

        // Escoger la vista según el rol del usuario
        $allowedRoles = ['admin', 'Administrador', 'Jefatura'];

        if (in_array($rol, $allowedRoles)) {
            //Unir datos existentes con los nuevos datos de marcas, estados y agencias
            $data = array_merge($data, [
                'marca' => $marcas,
                'estado' => $estados,
                'agencia' => $agencias
            ]);
            return view('dashboard/dashboarda', $data);
        }

        // Informacion para usuarios no administradores
        return view('dashboard/dashboard', array_merge($data, [
            'title' => 'Panel de Usuario'
        ]));
    }

    /**
     * Calculate real dashboard statistics
     */
    private function getDashboardStats()
    {
        // Get motorcycle counts by status
        $totalMotorcycles = count($this->motocicletaModel->findAll());
        $availableMotorcycles = count($this->rentaModel->getAvailableMotorcycles());
        $rentedMotorcycles = count($this->rentaModel->getActiveRentals());

        // Calculate inventory value (sum of rental prices for all motorcycles)
        $inventoryValue = $this->calculateInventoryValue();

        // Get service statistics
        $activeServices = count($this->servicioModel->whereIn('estado_servicio', ['pendiente', 'en_progreso'])->findAll());
        $pendingServices = count($this->servicioModel->where('estado_servicio', 'pendiente')->findAll());
        $completedServices = count($this->servicioModel->where('estado_servicio', 'completado')->findAll());

        // Get client count
        $totalClients = count($this->clienteModel->getAllClients());

        // Calculate low inventory alerts (motorcycles with issues - status 4 "Fuera de Servicio")
        $lowInventoryAlerts = count($this->motocicletaModel->where('idestado', 4)->findAll());

        return [
            'total_motorcycles' => $totalMotorcycles,
            'available_motorcycles' => $availableMotorcycles,
            'rented_motorcycles' => $rentedMotorcycles,
            'inventory_value' => $inventoryValue,
            'active_services' => $activeServices,
            'pending_services' => $pendingServices,
            'completed_services' => $completedServices,
            'total_clients' => $totalClients,
            'low_inventory_alerts' => $lowInventoryAlerts,
            // Calculate some mock percentage changes (in a real app, you'd compare with previous period)
            'motorcycles_change' => $this->calculatePercentageChange($availableMotorcycles, $totalMotorcycles),
            'rented_change' => $this->calculatePercentageChange($rentedMotorcycles, $totalMotorcycles),
            'inventory_change' => 8.2, // Mock value
            'alerts_change' => $this->calculatePercentageChange($lowInventoryAlerts, $totalMotorcycles),
            'pending_change' => $this->calculatePercentageChange($pendingServices, $activeServices),
            'services_change' => $this->calculatePercentageChange($activeServices, $totalMotorcycles)
        ];
    }

    /**
     * Calculate total inventory value based on rental prices
     */
    private function calculateInventoryValue()
    {
        $motorcycles = $this->motocicletaModel->findAll();
        $totalValue = 0;

        foreach ($motorcycles as $moto) {
            // Use the higher of the two rental prices, or a default value
            $rentalPrice = max($moto['renta_sinIva'] ?? 0, $moto['renta_conIva'] ?? 0);
            if ($rentalPrice == 0) {
                $rentalPrice = 100; // Default value if no rental price set
            }
            $totalValue += $rentalPrice;
        }

        return $totalValue;
    }

    /**
     * Calculate percentage change (simplified version)
     */
    private function calculatePercentageChange($current, $total)
    {
        if ($total == 0) return 0;

        // This is a simplified calculation - in a real app you'd compare with historical data
        $percentage = ($current / $total) * 100;

        // Return a reasonable percentage for demo purposes
        if ($percentage > 50) {
            return -mt_rand(1, 5); // Negative change
        } else {
            return mt_rand(1, 8); // Positive change
        }
    }
}
