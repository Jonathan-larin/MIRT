<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\MotocicletaModel;
use App\Models\MarcaModel;
use App\Models\EstadoModel;
use App\Models\AgenciaModel;
use App\Models\UsuarioModel;

class Dashboard extends BaseController
{
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

        // Preparar los datos para la vista
        $data = [
            'title' => 'Panel de Administrador',
            'user' => $user, // Datos completos del usuario desde BD
            'current_date' => date('d/m/Y'),
            'logged_in_user_id' => $userId // Pass user ID if needed for 'creadopor'
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
        return view('dashboard/dashboard', [
            'title' => 'Panel de Usuario',
            'user' => $user, // Database user data (already fetched above)
            'current_date' => date('d/m/Y')
        ]);
    }


}
