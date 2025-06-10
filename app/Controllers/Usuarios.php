<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $data['usuarios'] = $this->usuarioModel->findAll();
        return view('usuarios/index', $data);
    }

    public function create()
    {
        return view('usuarios/create');
    }

    public function store()
    {
        $rules = [
            'nombre'   => 'required|min_length[3]',
            'user'     => 'required|is_unique[usuario.user]',
            'password' => 'required|min_length[6]',
            'correo'   => 'required|valid_email',
            'dui'      => 'required|regex_match[/^[0-9]{8}-[0-9]$/]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $this->usuarioModel->save([
                'nombre'   => $this->request->getVar('nombre'),
                'user'     => $this->request->getVar('user'),
                'Password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'correo'   => $this->request->getVar('correo'),
                'estado'   => (bool)$this->request->getVar('estado'),
                'rol'      => $this->request->getVar('rol'),
                'dui'      => $this->request->getVar('dui'),
            ]);

            return redirect()->route('usuarios')->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear usuario.');
        }
    }

    public function edit($id)
    {
        $data['usuario'] = $this->usuarioModel->find($id);
        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nombre' => 'required|min_length[3]',
            'correo' => 'required|valid_email',
            'dui'    => 'required|regex_match[/^[0-9]{8}-[0-9]$/]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->usuarioModel->update($id, [
            'nombre'   => $this->request->getPost('nombre'),
            'user'     => $this->request->getPost('user'),
            'correo'   => $this->request->getPost('correo'),
            'estado'   => (bool)$this->request->getPost('estado'),
            'rol'      => $this->request->getPost('rol'),
            'dui'      => $this->request->getPost('dui'),
        ]);

        return redirect()->to('/usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    /*public function delete($id)
    {
        $this->usuarioModel->delete($id);
        return redirect()->to('/usuarios')->with('success', 'Usuario eliminado.');
    }*/

    public function delete($id)
    {
        $this->usuarioModel->delete($id);
        return $this->response->setJSON(['status' => 'ok']);
    }


    public function createViaAjax()
    {
        // Parse JSON
        $input = $this->request->getJSON(true) ?? [];

        // Validar campos
        $requiredFields = ['name', 'usuario', 'password', 'email', 'dui', 'estado', 'role'];
        foreach ($requiredFields as $field) {
            if (!isset($input[$field]) || trim($input[$field]) === '') {
                return $this->response->setStatusCode(400)->setJSON([
                    'error' => "Campo requerido: $field"
                ]);
            }
        }

        // Chequear formato DUI
        if (!preg_match('/^\d{8}-\d$/', $input['dui'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Formato de DUI inválido. Use 00000000-0.'
            ]);
        }

        $this->usuarioModel->insert([
            'nombre'   => trim($input['name']),
            'user'     => trim($input['usuario']),
            'Password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'correo'   => trim($input['email']),
            'dui'      => trim($input['dui']),
            'estado'   => $input['estado'] === 'activo' ? 1 : 0,
            'rol'      => trim($input['role']),
        ]);

        return $this->response->setJSON(['status' => 'ok']);
    }

    public function show($id)
    {
        $user = $this->usuarioModel->find($id);

        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Usuario no encontrado.']);
        }

        return $this->response->setJSON($user);
    }
    
    public function usuarios()
    {
        $data['usuarios'] = $this->usuarioModel->findAll();
      
        $formatter = new \IntlDateFormatter('es_ES', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
        $formatter->setPattern('d \'de\' MMMM, yyyy');
        $data['current_date'] = $formatter->format(new \DateTime());

        return view('usuarios/usuarios', $data);
    }

    public function createViaAjax2()
    {
        // Parse JSON
        $input = $this->request->getJSON(true) ?? [];

        // Validar campos
        $requiredFields = ['name', 'usuario', 'password', 'email', 'dui', 'estado', 'role'];
        foreach ($requiredFields as $field) {
            if (!isset($input[$field]) || trim($input[$field]) === '') {
                return $this->response->setStatusCode(400)->setJSON([
                    'error' => "Campo requerido: $field"
                ]);
            }
        }

        // Chequear formato DUI
        if (!preg_match('/^\d{8}-\d$/', $input['dui'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Formato de DUI inválido. Use 00000000-0.'
            ]);
        }

        $this->usuarioModel->insert([
            'nombre'   => trim($input['name']),
            'user'     => trim($input['usuario']),
            'Password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'correo'   => trim($input['email']),
            'dui'      => trim($input['dui']),
            'estado'   => $input['estado'] === 'activo' ? 1 : 0,
            'rol'      => trim($input['role']),
        ]);

        return $this->response->setJSON(['status' => 'ok']);
    }

    public function updateUser($id)
    {
        $data = $this->request->getJSON(true);

        if (!$this->usuarioModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Usuario no encontrado.']);
        }

        $this->usuarioModel->update($id, [
            'nombre' => $data['nombre'],
            'user'   => $data['user'],     
            'correo' => $data['correo'],
            'dui'    => $data['dui'],  
            'rol'    => $data['rol'],
            'estado' => $data['estado'],
        ]);


        return $this->response->setJSON(['status' => 'ok']);
    }



}
