<?php namespace App\Controllers;

class Dashboard extends BaseController
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        $rol = $session->get('rol');

        // Choose dashboard view based on role
        if ($rol === 'admin') {
            return view('dashboard/dashboarda', [
                'title' => 'Panel de Administrador',
                'nombre' => $session->get('nombre'),
                'current_date' => date('d/m/Y')
            ]);
        }

        return view('dashboard/dashboard', [
            'title' => 'Panel de Usuario',
            'nombre' => $session->get('nombre'),
            'current_date' => date('d/m/Y')
        ]);
    }
}
