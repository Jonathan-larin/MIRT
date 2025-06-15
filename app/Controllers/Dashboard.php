<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\MotocicletaModel;
use App\Models\MarcaModel;
use App\Models\EstadoModel;
use App\Models\AgenciaModel;

class Dashboard extends BaseController
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        $rol = $session->get('rol');

        // --- NEW: Instantiate Models and Fetch Data ---
        $marcaModel = new MarcaModel();
        $estadoModel = new EstadoModel();
        $agenciaModel = new AgenciaModel();

        $marcas = $marcaModel->findAll();
        $estados = $estadoModel->findAll();
        $agencias = $agenciaModel->findAll();
        // --- END NEW DATA FETCH ---

        // Prepare base data for the view
        $data = [
            'title' => 'Panel de Administrador',
            'nombre' => $session->get('nombre'),
            'current_date' => date('d/m/Y'),
            'logged_in_user_id' => $session->get('user_id') // Pass user ID if needed for 'creadopor'
        ];

        // Choose dashboard view based on role
        if ($rol === 'admin') {
            // Merge the existing data with the new dropdown data
            $data = array_merge($data, [
                'marca' => $marcas,
                'estado' => $estados,
                'agencia' => $agencias
            ]);
            return view('dashboard/dashboarda', $data);
        }

        // For other roles, if 'dashboard/dashboard' also needs the modals,
        // you'd need to fetch and pass the data there too.
        return view('dashboard/dashboard', [
            'title' => 'Panel de Usuario',
            'nombre' => $session->get('nombre'),
            'current_date' => date('d/m/Y')
        ]);
    }
}