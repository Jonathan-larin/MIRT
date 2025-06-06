<?php namespace App\Controllers;

use App\Models\MotoModel;
use App\Models\MarcaModel;
use App\Models\ClienteModel;
use App\Models\EstadoModel;

class Motos extends BaseController
{
    protected $motoModel;

    public function __construct()
    {
        $this->motoModel = new MotoModel();
    }

    public function index()
    {
        $data['motos'] = $this->motoModel->withRelations();
        return view('motos/index', $data);
    }

    public function create()
    {
        return view('motos/create');
    }

    public function store()
    {
        $this->motoModel->insert($this->request->getPost());
        return redirect()->to('/motos');
    }

    public function edit($placa)
    {
        $data['moto'] = $this->motoModel->find($placa);
        return view('motos/edit', $data);
    }

    public function update($placa)
    {
        $this->motoModel->update($placa, $this->request->getPost());
        return redirect()->to('/motos');
    }

    public function delete($placa)
    {
        $this->motoModel->delete($placa);
        return redirect()->to('/motos');
    }
}
