<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function loginForm()
    {    
        $session = session();
        $logoutMessage = $this->request->getCookie('logout_message');

        if ($logoutMessage) {
            $session->setFlashdata('message', $logoutMessage);
        }

        return view('login');
    
    }

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
    $response = service('response');
    session()->destroy();
    // Set a cookie for the message (expires in 10 seconds)
    $response->setCookie('logout_message', 'Sesión cerrada correctamente.', 10);

    return $response->redirect('/login');
}

}
