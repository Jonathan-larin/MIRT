<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\MotocicletaModel;
use App\Models\MarcaModel; 
use App\Models\EstadoModel;   
use App\Models\AgenciaModel;

class Motocicletas extends BaseController
{
    use ResponseTrait;

    protected $motocicletaModel;
    protected $marcaModel;
    protected $estadoModel;
    protected $agenciaModel;
    

    public function __construct()
    {
        $this->motocicletaModel = new MotocicletaModel();
        $this->marcaModel = new MarcaModel();
        $this->estadoModel = new EstadoModel();
        $this->agenciaModel = new AgenciaModel();
    }

    /**
     * Muestra la página principal de motocicletas con un listado y el formulario de creación.
     */
    public function index()
    {
        // Cargar todos los datos necesarios para la vista
        $data['motocicletas'] = $this->motocicletaModel
                                 ->select('motos.*, marca.marca AS nombre_marca, estado.estado AS nombre_estado, agencia.agencia AS nombre_agencia')
                                 ->join('marca', 'marca.idmarca = motos.idmarca') 
                                 ->join('estado', 'estado.idestado = motos.idestado')
                                 ->join('agencia', 'agencia.idagencia = motos.idagencia', 'left')
                                 ->findAll();

        $data['marca'] = $this->marcaModel->findAll();
        $data['estado'] = $this->estadoModel->findAll();
        $data['agencia'] = $this->agenciaModel->findAll();

        // Variables adicionales que la vista pueda necesitar
        $data['current_date'] = date('d/m/Y');
        
        $data['logged_in_user_id'] = session()->get('idUsuario');
        $data['logged_in_username'] = session()->get('nombreUsuario');

        // Cargar la vista principal de motocicletas
        return view('motocicletas/motocicletas', $data);
    }

    /**
     * Maneja la creación de una nueva motocicleta vía AJAX.
     */
    public function createViaAjax()
    {
        $input = $this->request->getJSON(true);

        if (empty($input)) {
            return $this->fail('No se recibieron datos.', 400);
        }

        $loggedInUserId = session()->get('idUsuario');
        if (!$loggedInUserId) {
            return $this->failUnauthorized('Usuario no autenticado.');
        }

        $rules = [
            'placa'       => 'required|max_length[15]|is_unique[motos.placa]',
            'marca'       => 'required|integer',
            'modelo'      => 'required|min_length[2]|max_length[50]',
            'anio'        => 'required|integer|exact_length[4]',
            'kilometraje' => 'required|max_length[50]',
            'idestado'    => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $data = [
            'placa'       => $input['placa'],
            'idestado'    => $input['idestado'],
            'idmarca'     => $input['marca'],
            'modelo'      => $input['modelo'],
            'año'         => $input['anio'],
            'Motor'       => $input['kilometraje'],
            'creado_por'  => $loggedInUserId,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'activo'      => 1,

            'chasis'      => $input['chasis'] ?? null,
            'idcliente'   => $input['idcliente'] ?? null,
            'Sucursal'    => $input['sucursal'] ?? null,
            'color'       => $input['color'] ?? null,
            'fecha_entrega' => $input['fecha_entrega'] ?? null,
            'fecha_renovacion' => $input['fecha_renovacion'] ?? null,
            'Envio'       => $input['envio'] ?? null,
            'taller'      => $input['taller'] ?? null,
            'iddepartamento' => $input['iddepartamento'] ?? null,
            'idagencia'   => $input['idagencia'] ?? null,
            'renta_sinIva' => $input['renta_sinIva'] ?? null,
            'renta_conIva' => $input['renta_conIva'] ?? null,
            'naf'         => $input['naf'] ?? null,
        ];

        try {
            if ($this->motocicletaModel->insert($data)) {
                return $this->respondCreated(['message' => 'Motocicleta agregada exitosamente.', 'id' => $this->motocicletaModel->getInsertID()]);
            } else {
                $errors = $this->motocicletaModel->errors();
                if (!empty($errors)) {
                    log_message('error', 'Error de validación del modelo al insertar motocicleta: ' . json_encode($errors));
                    return $this->fail($errors, 400);
                } else {
                    log_message('error', 'Error desconocido al guardar la motocicleta en la base de datos.');
                    return $this->fail('Error desconocido al guardar la motocicleta en la base de datos.', 500);
                }
            }
        } catch (\CodeIgniter\Database\Exception\DatabaseException $e) {
            log_message('error', 'Error de la base de datos al insertar motocicleta: ' . $e->getMessage() . ' SQL: ' . $e->getQuery());
            return $this->fail('Error de la base de datos: ' . $e->getMessage(), 500);
        } catch (\Exception $e) {
            log_message('error', 'Excepción inesperada al insertar motocicleta: ' . $e->getMessage());
            return $this->fail('Error inesperado: ' . $e->getMessage(), 500);
        }
    }

    public function getMotocicletaDetails($placa)
    {
        // Aegurarse de que la solicitud es AJAX
        if (!$this->request->isAJAX()) {
            // Si no es una solicitud AJAX, retornar un error 401 Unauthorized
            return $this->failUnauthorized('Acceso no autorizado.');
        }

        // Obtener los detalles de la motocicleta por placa
        $motocicleta = $this->motocicletaModel
                            ->select('motos.*, marca.marca AS nombre_marca, estado.estado AS nombre_estado, agencia.agencia AS nombre_agencia')
                            ->join('marca', 'marca.idmarca = motos.idmarca')
                            ->join('estado', 'estado.idestado = motos.idestado')
                            ->join('agencia', 'agencia.idagencia = motos.idagencia', 'left') // Use LEFT JOIN
                            ->find($placa); // Use the primary key to find the specific motorcycle

        if ($motocicleta) {
            // Retornar los detalles de la motocicleta como respuesta JSON
            return $this->respond($motocicleta);
        } else {
            // Si la motocicleta no se encuentra, retornar un error 404 Not Found
            return $this->failNotFound('Motocicleta no encontrada.');
        }
    }

    public function update($placa)
    {
        // Asegurarse de que la solicitud es AJAX y es un método POST
        if (!$this->request->isAJAX() || !$this->request->is('post')) {
            return $this->failUnauthorized('Acceso no autorizado o método no permitido.');
        }

        // Obtener los datos del cuerpo de la solicitud
        $data = $this->request->getJSON(true); // verdadero para obtener un array asociativo

        // Validar los datos recibidos)
        if (!$this->motocicletaModel->validate($data)) {
            return $this->failValidationErrors($this->motocicletaModel->errors());
        }

        // Intentar actualizar la motocicleta
        if ($this->motocicletaModel->update($placa, $data)) {
            return $this->respondUpdated(['message' => 'Motocicleta actualizada exitosamente.', 'placa' => $placa]);
        } else {
            // Si la actualización falla, retornar un error 500 Internal Server Error
            return $this->failServerError('No se pudo actualizar la motocicleta. Intente de nuevo.');
        }
    }

    public function delete($placa = null)
    {
        // Asegurarse de que la solicitud es AJAX
        if (!$this->request->isAJAX()) {
            return $this->failUnauthorized('Acceso no autorizado para eliminar.');
        }

        // Validar que se ha proporcionado una placa

        if ($placa === null) {
            return $this->failNotFound('No se especificó la placa de la motocicleta a eliminar.');
        }

        // Verificar si la motocicleta existe

        if ($this->motocicletaModel->delete($placa)) {
            return $this->respondDeleted(['message' => 'Motocicleta eliminada exitosamente.']);
        } 
        
        // Si la motocicleta no se pudo eliminar, verificar si existe
        
        else {
            return $this->failServerError('No se pudo eliminar la motocicleta. Podría no existir o tener dependencias.');
        }
    }

}