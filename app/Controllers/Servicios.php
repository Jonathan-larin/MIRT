<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicioModel;
use App\Models\MotocicletaModel;
use App\Models\MarcaModel;
use App\Models\EstadoModel;
use App\Models\AgenciaModel;

class Servicios extends BaseController
{
    protected $servicioModel;
    protected $motocicletaModel;
    protected $marcaModel;
    protected $estadoModel;
    protected $agenciaModel;

    public function __construct()
    {
        $this->servicioModel = new ServicioModel();
        $this->motocicletaModel = new MotocicletaModel();
        $this->marcaModel = new MarcaModel();
        $this->estadoModel = new EstadoModel();
        $this->agenciaModel = new AgenciaModel();
    }

    public function index()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Get data for filters
        $marca = $this->marcaModel->findAll();
        $estado = $this->estadoModel->findAll();
        $agencia = $this->agenciaModel->findAll();

        // Get services with motorcycle details
        $servicios = $this->servicioModel->getWithMotorcycle();

        $data = [
            'title' => 'Gestión de Servicios',
            'servicios' => $servicios,
            'marca' => $marca,
            'estado' => $estado,
            'agencia' => $agencia,
            'current_date' => date('d/m/Y')
        ];

        return view('servicios/index', $data);
    }

    public function createViaAjax()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Usuario no autenticado'
            ])->setStatusCode(401);
        }

        $json = $this->request->getJSON();

        if (!$json) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Datos JSON requeridos'
            ])->setStatusCode(400);
        }

        // Prepare data
        $data = [
            'placa_motocicleta' => $json->placa_motocicleta ?? '',
            'tipo_servicio' => $json->tipo_servicio ?? '',
            'descripcion' => $json->descripcion ?? '',
            'estado_servicio' => $json->estado_servicio ?? 'pendiente',
            'fecha_solicitud' => $json->fecha_solicitud ?? date('Y-m-d'),
            'costo_estimado' => $json->costo_estimado ?? null,
            'tecnico_responsable' => $json->tecnico_responsable ?? null,
            'prioridad' => $json->prioridad ?? 'media',
            'kilometraje_actual' => $json->kilometraje_actual ?? null,
            'creado_por' => $session->get('idUsuario')
        ];

        if (!$this->servicioModel->insert($data)) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Error al crear servicio: ' . implode(', ', $this->servicioModel->errors())
            ])->setStatusCode(400);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Servicio creado exitosamente'
        ]);
    }

    public function details($id)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Usuario no autenticado'
            ])->setStatusCode(401);
        }

        $servicio = $this->servicioModel->getServiceWithMotorcycle($id);

        if (!$servicio) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Servicio no encontrado'
            ])->setStatusCode(404);
        }

        return $this->response->setJSON($servicio);
    }

    public function update($id)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Usuario no autenticado'
            ])->setStatusCode(401);
        }

        $json = $this->request->getJSON();

        if (!$json) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Datos JSON requeridos'
            ])->setStatusCode(400);
        }

        // Prepare data
        $data = [
            'placa_motocicleta' => $json->placa_motocicleta ?? '',
            'tipo_servicio' => $json->tipo_servicio ?? '',
            'descripcion' => $json->descripcion ?? '',
            'estado_servicio' => $json->estado_servicio ?? '',
            'fecha_solicitud' => $json->fecha_solicitud ?? '',
            'fecha_inicio' => $json->fecha_inicio ?? null,
            'fecha_completado' => $json->fecha_completado ?? null,
            'costo_estimado' => $json->costo_estimado ?? null,
            'costo_real' => $json->costo_real ?? null,
            'tecnico_responsable' => $json->tecnico_responsable ?? null,
            'notas' => $json->notas ?? null,
            'prioridad' => $json->prioridad ?? '',
            'kilometraje_actual' => $json->kilometraje_actual ?? null,
            'modificado_por' => $session->get('idUsuario')
        ];

        if (!$this->servicioModel->update($id, $data)) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Error al actualizar servicio: ' . implode(', ', $this->servicioModel->errors())
            ])->setStatusCode(400);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Servicio actualizado exitosamente'
        ]);
    }

    public function delete($id)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Usuario no autenticado'
            ])->setStatusCode(401);
        }

        if (!$this->servicioModel->delete($id)) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Error al eliminar servicio'
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Servicio eliminado exitosamente'
        ]);
    }

    public function getMotocicletas()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Usuario no autenticado'
            ])->setStatusCode(401);
        }

        $motocicletas = $this->motocicletaModel->select('motos.placa, motos.modelo, marca.marca AS nombre_marca, motos.año')
                                               ->join('marca', 'marca.idmarca = motos.idmarca')
                                               ->findAll();

        return $this->response->setJSON($motocicletas);
    }
}
