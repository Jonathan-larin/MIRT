<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function loginForm()
    {
        // Show login view
        return view('login');
    }

   /* public function doLogin()
    {
        $session = session();
        $usuarioModel = new UsuarioModel();

        $userInput = $this->request->getVar('user');
        $passInput = $this->request->getVar('password');

        $user = $usuarioModel->where('user', $userInput)->first();

        if ($user && password_verify($passInput, $user['Password'])) {
            // Set session data
            $session->set([
                'idUsuario'   => $user['idUsuario'],
                'nombre'      => $user['nombre'],
                'rol'         => $user['rol'],
                'isLoggedIn'  => true
            ]);

            // Role-based redirection
            if ($user['rol'] === 'admin') {
                return redirect()->to('/dashboarda');
            }
            return redirect()->to('/dashboard');
        }

        // Login failed
        return redirect()->back()->with('error', 'Usuario o contraseña inválidos.');
    }*/

public function doLogin()
{
    helper('form');
    $session = session();
    $usuarioModel = new \App\Models\UsuarioModel();

    // Get and sanitize input
    $username = trim($this->request->getVar('usuario'));
    $password = trim($this->request->getVar('password'));

    // Lookup user by 'user' field
    $user = $usuarioModel->where('user', $username)->first();

    if ($user && password_verify($password, $user['Password'])) {
        
        // Valid login, set session
        $session->set([
            'idUsuario'   => $user['idUsuario'],
            'nombre'      => $user['nombre'],
            'rol'         => $user['rol'],
            'isLoggedIn'  => true
        ]);

        // Redirect based on role
        return redirect()->to($user['rol'] === 'admin' ? '/dashboarda' : '/dashboard');        

    }

    // Invalid login
    return redirect()->back()->with('error', 'Usuario o contraseña inválidos.');    
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Sesión cerrada correctamente.');
    }
}
