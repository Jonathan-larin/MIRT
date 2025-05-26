<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form']);

        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [];

        if ($this->request->getMethod() == 'post') {
            // Validate input
            $rules = [
                'usuario'  => 'required',
                'password' => 'required',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $usuario = $this->request->getPost('usuario');
                $password = $this->request->getPost('password');

                $user = $model->getUserByUsername($usuario);

                if ($user && password_verify($password, $user['Password'])) {
                    // Set session data
                    session()->set([
                        'idUsuario' => $user['idUsuario'],
                        'nombre'    => $user['nombre'],
                        'isLoggedIn'=> true,
                    ]);
                    return redirect()->to('/dashboard'); // or wherever you want to redirect after login
                } else {
                    $data['error'] = 'Usuario o contraseña incorrectos.';
                }
            }
        }

        echo view('login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}