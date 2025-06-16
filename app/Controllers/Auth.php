<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    // Muestra el formulario de inicio de sesión
    
    public function loginForm()
    {    
        $session = session();
        $logoutMessage = $this->request->getCookie('logout_message');

        if ($logoutMessage) {
            $session->setFlashdata('message', $logoutMessage);
        }

        return view('login');
    
    }

    // Maneja el inicio de sesión del usuario

    public function doLogin()
    {
        helper('form');
        $session = session();
        $usuarioModel = new \App\Models\UsuarioModel();

        // Obtener y limpiar los datos del formulario
        $username = trim($this->request->getVar('usuario'));
        $password = trim($this->request->getVar('password'));

        //  Validar los datos del formulario
        $user = $usuarioModel->where('user', $username)->first();

        if ($user && password_verify($password, $user['Password'])) {
            
            // Login valido establecer los datos de sesión
            $session->set([
                'idUsuario'   => $user['idUsuario'],
                'nombre'      => $user['nombre'],
                'rol'         => $user['rol'],
                'isLoggedIn'  => true
            ]);

            // Redireccion a la página de dashboard según el rol del usuario
            return redirect()->to($user['rol'] === 'admin' ? '/dashboarda' : '/dashboard');        

        }

        // Login inválido, redireccionar de vuelta al formulario con un mensaje de error
        return redirect()->back()->with('error', 'Usuario o contraseña inválidos.');    
    }

    // Método para cerrar sesión

    public function logout()
{
    $response = service('response');
    session()->destroy();
    // Usar cookie para mostrar mensaje de cierre de sesión
    $response->setCookie('logout_message', 'Sesión cerrada correctamente.', 10);

    return $response->redirect('/login');
}

}
