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
        } 
        
        catch (\Exception $e) {
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
        $this->usuarioModel->update($id, [
            'nombre'   => $this->request->getPost('nombre'),
            'user'     => $this->request->getPost('user'),
            'correo'   => $this->request->getPost('correo'),
            'estado'   => $this->request->getPost('estado'),
            'rol'      => $this->request->getPost('rol'),
            'dui'      => $this->request->getPost('dui'),
        ]);

        return redirect()->to('/usuarios');
    }

    public function delete($id)
    {
        $this->usuarioModel->delete($id);
        return redirect()->to('/usuarios');
    }
}
