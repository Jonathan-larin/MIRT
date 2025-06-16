<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MI Renta Total - Motocicletas</title>
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#0D3850',
            primaryb: '#0B3C59',
            grayb: '#E3E8EB',
            secondary: '#AD2E2E'
          },
          borderRadius: {
            'none': '0px',
            'sm': '4px',
            DEFAULT: '8px',
            'md': '12px',
            'lg': '16px',
            'xl': '20px',
            '2xl': '24px',
            '3xl': '32px',
            'full': '9999px',
            'button': '8px'
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
  </style>
</head>

<body class="bg-white">
  <header class="bg-primary shadow-sm fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center justify-between px-6 py-1">
            
            <div class="flex items-center">
                <img src="<?= base_url('images/logow.png')?>" alt="MIRentaLogo" class="h-10 max-h-10 mr-4">
                <nav class="hidden md:flex items-center space-x-1">
                    
                <a href="dashboard"
                class="flex items-center px-3 py-2 text-sm font-medium text-white bg-secondary rounded">
                    <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                        <i class="ri-dashboard-line"></i>
                    </div>
                    Panel de Control
                </a>     
                </nav>                
            </div>


            <div class="flex items-center space-x-4">

            <div class="relative group">
                    <button>
                        <a href="/usuarios"   
                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                            <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                                <i class="ri-user-line"></i>
                            </div>
                            Usuarios
                        </a>
                    </button>                  
                </div>
                    
                <div class="relative group">
                    <button>
                        <a href="/motocicletas"
                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                            <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                                <i class="ri-motorbike-line"></i>
                            </div>
                            Motocicletas
                        </a>                        
                    </button> 
                </div>
                    
                <div class="relative group">
                    <button>
                        <a href="#"
                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                            <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                                <i class="ri-money-dollar-circle-line"></i>
                            </div>
                            Clientes
                        </a>
                    </button>
                </div>

                <button class="relative p-1 text-white hover:text-secondary focus:outline-none">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-notification-3-line"></i>
                    </div>
                   </button>
                <div class="relative group">
                    <button class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-white">
                            <i class="ri-user-line"></i>
                        </div>
                        <span class="text-sm font-medium text-white hidden md:block">
                            <?php
                            $session = session();                            
                            echo esc($session->get('nombre') ?: 'Invitado');
                            ?>
                        </span>
                        <div class="w-4 h-4 flex items-center justify-center">
                            <i class="ri-arrow-down-s-line" style="color: white;"></i>
                        </div>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-primary hover:text-white hover:bg-secondary">
                            <div class="w-4 h-4 flex items-center justify-center mr-2">
                                <i class="ri-user-settings-line"></i>
                            </div>
                            Perfil
                        </a>                        
                        <div class="border-t border-gray-100 my-1"></div>

                        <a href="/logout" class="flex items-center px-4 py-2 text-sm text-red-600 hover:text-white hover:bg-secondary">
                            <div class="w-4 h-4 flex items-center justify-center mr-2">
                                <i class="ri-logout-box-r-line"></i>
                            </div>
                            Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:hidden px-4 pb-4">
            <button id="mobileMenuButton"
                class="flex items-center px-3 py-2 border border-gray-300 rounded text-grayb hover:text-primary hover:border-primary whitespace-nowrap !rounded-button">
                <div class="w-5 h-5 flex items-center justify-center mr-1">
                    <i class="ri-menu-line"></i>
                </div>
                Menu
            </button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden px-4 pb-4">
            <nav class="flex flex-col space-y-2">
                <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-primary bg-blue-50 rounded">
                    <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                        <i class="ri-dashboard-line"></i>
                    </div>
                    Dashboard
                </a>
                <div class="mobile-dropdown">
                    <button
                        class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-primary hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                        <div class="flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                                <i class="ri-motorbike-line"></i>
                            </div>
                            Products
                        </div>
                        <div class="w-4 h-4 flex items-center justify-center">
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                    </button>
                    <div class="hidden pl-8 mt-1 space-y-1">
                        <a href="#"
                            class="block px-3 py-2 text-sm text-primary hover:text-white hover:bg-secondary rounded">Catalog</a>
                        <a href="#"
                            class="block px-3 py-2 text-sm text-primary hover:text-white hover:bg-secondary rounded">Categories</a>
                        <a href="#"
                            class="block px-3 py-2 text-sm text-primary hover:text-white hover:bg-secondary rounded">New
                            Listing</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

  <main class="pt-24 pb-12 px-4 md:px-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-primary">Gestión de Motocicletas</h1>
      <div class="flex items-center space-x-2">
        <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>
        
        <button id="addMotorcycleButton"
          class="bg-primary text-white px-4 py-2 rounded-button hover:bg-secondary transition-all duration-200 flex items-center whitespace-nowrap !rounded-button">
          <div class="w-4 h-4 flex items-center justify-center mr-1.5">
            <i class="ri-add-line"></i>
          </div>
          Nueva Motocicleta
        </button>
      </div>      
    </div>

    
    <div id="addMotorcycleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
      <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-bold text-primary">Agregar Nueva Motocicleta</h3>
          <button id="closeAddMotorcycleModal" class="text-gray-400 hover:text-gray-700">
            <i class="ri-close-line text-xl"></i>
          </button>
        </div>
        <form id="motorcycleForm" class="space-y-4">
          <div>
            <label for="placa" class="block text-sm font-medium text-gray-700 mb-1">Placa</label>
            <input type="text" id="placa" name="placa" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none" required>
          </div>
          <div>
            <label for="marca" class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
            <select id="marca" name="marca" class="w-full px-3 py-2 border border-gray-300 rounded-button" required>
              <option value="">Seleccione una marca</option>
              <?php if (!empty($marca)): ?>
                <?php foreach ($marca as $m): ?>
                  <option value="<?= esc($m['idmarca']) ?>"><?= esc($m['marca']) ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <div>
            <label for="modelo" class="block text-sm font-medium text-gray-700 mb-1">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none" required>
          </div>
          <div>
            <label for="anio" class="block text-sm font-medium text-gray-700 mb-1">Año</label>
            <input type="number" id="anio" name="anio" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none" min="1900" max="<?= date('Y') + 1 ?>" required>
          </div>
          <div>
            <label for="kilometraje" class="block text-sm font-medium text-gray-700 mb-1">Kilometraje / Motor</label>
            <input type="text" id="kilometraje" name="kilometraje" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none" required>
          </div>

          <div>
            <label for="idagencia" class="block text-sm font-medium text-gray-700 mb-1">Agencia</label>
            <select id="idagencia" name="idagencia" class="w-full px-3 py-2 border border-gray-300 rounded-button"> <option value="">Seleccione una agencia</option>
              <?php if (!empty($agencia)): ?>
                <?php foreach ($agencia as $a):?>
                  <option value="<?= esc($a['idagencia']) ?>"><?= esc($a['agencia']) ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div>
            <label for="idestado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
            <select id="idestado" name="idestado" class="w-full px-3 py-2 border border-gray-300 rounded-button" required>
              <option value="">Seleccione un estado</option>
              <?php if (!empty($estado)):?>
                <?php foreach ($estado as $e): ?>
                  <option value="<?= esc($e['idestado']) ?>"><?= esc($e['estado']) ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <input type="hidden" id="creadopor" name="creadopor" value="<?= esc($logged_in_user_id ?? '') ?>">
          <div class="flex justify-end space-x-2 pt-2">
            <button type="button" id="cancelAddMotorcycle" class="px-4 py-2 text-sm font-medium text-primary bg-gray-100 rounded-button hover:text-white hover:bg-secondary">Cancelar</button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-button hover:text-white hover:bg-secondary">Guardar</button>
          </div>
      </form>
      </div>
    </div>

    <div class="bg-white p-6 rounded shadow">
      <h2 class="text-xl font-bold mb-4">Lista de Motocicletas</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marca</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modelo</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Año</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Agencia</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($motocicletas)): ?>
              <?php foreach ($motocicletas as $moto): ?>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-900"><?= esc($moto['nombre_marca']) ?></td>
                  <td class="px-6 py-4 text-sm text-gray-500"><?= esc($moto['modelo']) ?></td>
                  <td class="px-6 py-4 text-sm text-gray-500"><?= esc($moto['año']) ?></td> 
                  <td class="px-6 py-4 text-sm">
                    <?php 
                      $estadoTexto = 'Desconocido';
                      $estadoClase = 'bg-gray-100 text-gray-800';
                      switch ($moto['nombre_estado']) { // Asume que 'estado' es el nombre o ID del estado
                        case 'Disponible':
                        case 1: // Si idestado es 1
                          $estadoTexto = 'Disponible';
                          $estadoClase = 'bg-green-100 text-green-800';
                          break;
                        case 'En Mantenimiento':
                        case 2: // Si idestado es 2
                          $estadoTexto = 'En Mantenimiento';
                          $estadoClase = 'bg-yellow-100 text-yellow-800';
                          break;
                        case 'Alquilada':
                        case 3: // Si idestado es 3
                          $estadoTexto = 'Alquilada';
                          $estadoClase = 'bg-blue-100 text-blue-800';
                          break;
                        case 'Fuera de Servicio':
                        case 4: // Si idestado es 4
                          $estadoTexto = 'Fuera de Servicio';
                          $estadoClase = 'bg-red-100 text-red-800';
                          break;
                      }
                    ?>
                    <span class="px-2 py-1 text-xs font-medium rounded-full <?= $estadoClase ?>">
                      <?= esc($estadoTexto) ?>
                    </span>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500">
                    <?= esc($moto['nombre_agencia'] ?? 'N/A') ?> 
                  </td>
                  <td class="px-6 py-4 text-sm font-medium">
                    <button class="view-motorcycle text-primary hover:text-primary/80 mr-3" data-motorcycle-id="<?= esc($moto['placa']) ?>">
                      <i class="ri-eye-line"></i>
                    </button>
                    <button class="edit-motorcycle text-primary hover:text-primary/80 mr-3" data-motorcycle-id="<?= esc($moto['placa']) ?>">
                      <i class="ri-pencil-line"></i>
                    </button>
                    <button class="delete-motorcycle text-red-600 hover:text-red-800" data-motorcycle-id="<?= esc($moto['placa']) ?>">
                      <i class="ri-delete-bin-line"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No hay motocicletas registradas.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    
    <!-- Detalles de la Motocicleta Modal -->


    <div id="motorcycleDetailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden flex justify-center items-center">
      <div class="relative bg-white rounded-lg shadow-xl p-6 w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
          <h3 class="text-2xl font-semibold text-gray-800">Detalles de la Motocicleta</h3>
          <button id="closeDetailModalXBtn" class="text-gray-400 hover:text-gray-600"> <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-left text-gray-700">
          <div>
            <p class="mb-2"><span class="font-medium text-gray-900">Placa:</span> <span id="detailMotorcyclePlaca"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Marca:</span> <span id="detailMotorcycleMarca"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Modelo:</span> <span id="detailMotorcycleModelo"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Año:</span> <span id="detailMotorcycleAnio"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Motor:</span> <span id="detailMotorcycleMotor"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Estado:</span> <span id="detailMotorcycleEstado"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Agencia:</span> <span id="detailMotorcycleAgencia"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Chasis:</span> <span id="detailMotorcycleChasis"></span></p>
          </div>

          <div>
            <p class="mb-2"><span class="font-medium text-gray-900">Cliente ID:</span> <span id="detailMotorcycleIdCliente"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Color:</span> <span id="detailMotorcycleColor"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Fecha Entrega:</span> <span id="detailMotorcycleFechaEntrega"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Fecha Renovación:</span> <span id="detailMotorcycleFechaRenovacion"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Envío:</span> <span id="detailMotorcycleEnvio"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Taller:</span> <span id="detailMotorcycleTaller"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Departamento ID:</span> <span id="detailMotorcycleIdDepartamento"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Renta sin IVA:</span> <span id="detailMotorcycleRentaSinIva"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">Renta con IVA:</span> <span id="detailMotorcycleRentaConIva"></span></p>
            <p class="mb-2"><span class="font-medium text-gray-900">NAF:</span> <span id="detailMotorcycleNAF"></span></p>
          </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 mt-6 border-t"> <button id="editFromDetailModalBtn" class="px-6 py-2 bg-gray-200 text-primary rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-blue-500">
            Editar
          </button>
          <button id="closeDetailModalBtn" class="px-6 py-2 bg-primary text-white rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-gray-400">
            Cerrar
          </button>
        </div>
      </div>
    </div>

    <!-- Modal para editar motocicleta -->

    <div id="editMotorcycleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden flex justify-center items-center">
      <div class="relative bg-white rounded-lg shadow-xl p-6 w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
          <h3 class="text-2xl font-semibold text-gray-800">Editar Motocicleta</h3>
          <button id="closeEditMotorcycleModalXBtn" class="text-gray-400 hover:text-gray-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <form id="editMotorcycleForm" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
          <input type="hidden" id="editMotorcyclePlacaHidden" name="placa">

          <!-- Primera columna de campos -->

          <div>
            <div class="mb-4">
              <label for="editPlaca" class="block text-sm font-medium text-gray-700 mb-1">Placa</label>
              <input type="text" id="editPlaca" name="placa" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required readonly>
              </div>

            <div class="mb-4">
              <label for="editMarca" class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
              <select id="editMarca" name="idmarca" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Seleccione una marca</option>
                <?php if (!empty($marca)): ?>
                  <?php foreach ($marca as $m): ?>
                    <option value="<?= esc($m['idmarca']) ?>"><?= esc($m['marca']) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <div class="mb-4">
              <label for="editModelo" class="block text-sm font-medium text-gray-700 mb-1">Modelo</label>
              <input type="text" id="editModelo" name="modelo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
              <label for="editAnio" class="block text-sm font-medium text-gray-700 mb-1">Año</label>
              <input type="number" id="editAnio" name="año" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required min="1900" max="<?= date('Y') + 1 ?>">
            </div>

            <div class="mb-4">
              <label for="editMotor" class="block text-sm font-medium text-gray-700 mb-1">Motor</label>
              <input type="text" id="editMotor" name="Motor" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            
            <div class="mb-4">
              <label for="editEstado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
              <select id="editEstado" name="idestado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Seleccione un estado</option>
                <?php if (!empty($estado)): ?>
                  <?php foreach ($estado as $e): ?>
                    <option value="<?= esc($e['idestado']) ?>"><?= esc($e['estado']) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <div class="mb-4">
              <label for="editAgencia" class="block text-sm font-medium text-gray-700 mb-1">Agencia</label>
              <select id="editAgencia" name="idagencia" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">Seleccione una agencia</option>
                <?php if (!empty($agencia)): ?>
                  <?php foreach ($agencia as $a): ?>
                    <option value="<?= esc($a['idagencia']) ?>"><?= esc($a['agencia']) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <div class="mb-4">
              <label for="editChasis" class="block text-sm font-medium text-gray-700 mb-1">Chasis</label>
              <input type="text" id="editChasis" name="chasis" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>            
            
            <div class="mb-4">
              <label for="editColor" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
              <input type="text" id="editColor" name="color" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

          </div>

          <!-- Segunda columna de campos -->

          <div>

            <div class="mb-4">
              <label for="editIdCliente" class="block text-sm font-medium text-gray-700 mb-1">ID Cliente</label>
              <input type="number" id="editIdCliente" name="idcliente" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>            

            <div class="mb-4">
              <label for="editFechaEntrega" class="block text-sm font-medium text-gray-700 mb-1">Fecha Entrega</label>
              <input type="date" id="editFechaEntrega" name="fecha_entrega" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editFechaRenovacion" class="block text-sm font-medium text-gray-700 mb-1">Fecha Renovación</label>
              <input type="date" id="editFechaRenovacion" name="fecha_renovacion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editEnvio" class="block text-sm font-medium text-gray-700 mb-1">Envío</label>
              <input type="text" id="editEnvio" name="Envio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editTaller" class="block text-sm font-medium text-gray-700 mb-1">Taller</label>
              <input type="text" id="editTaller" name="taller" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editIdDepartamento" class="block text-sm font-medium text-gray-700 mb-1">ID Departamento</label>
              <input type="number" id="editIdDepartamento" name="iddepartamento" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editRentaSinIva" class="block text-sm font-medium text-gray-700 mb-1">Renta sin IVA</label>
              <input type="number" step="0.01" id="editRentaSinIva" name="renta_sinIva" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editRentaConIva" class="block text-sm font-medium text-gray-700 mb-1">Renta con IVA</label>
              <input type="number" step="0.01" id="editRentaConIva" name="renta_conIva" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="editNAF" class="block text-sm font-medium text-gray-700 mb-1">NAF</label>
              <input type="text" id="editNAF" name="naf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>
        </form>

        <div class="flex justify-end gap-3 pt-4 mt-6 border-t">
          <button type="submit" form="editMotorcycleForm" class="px-6 py-2 bg-gray-200 text-primary rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-blue-500">
            Guardar Cambios
          </button>
          <button id="cancelEditMotorcycle" class="px-6 py-2 bg-primary text-white rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-gray-400">
            Cancelar
          </button>
        </div>
      </div>
    </div>


  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Referencias a los modales
      const addMotorcycleModal = document.getElementById('addMotorcycleModal');
      const motorcycleDetailModal = document.getElementById('motorcycleDetailModal');
      const editMotorcycleModal = document.getElementById('editMotorcycleModal');

      // Referencias a los botones para abrir/cerrar el modal de agregar
      const addMotorcycleButton = document.getElementById('addMotorcycleButton');
      const closeAddMotorcycleModal = document.getElementById('closeAddMotorcycleModal');
      const cancelAddMotorcycle = document.getElementById('cancelAddMotorcycle');

      //Boton editar desde el modal de detalles
      const editFromDetailModalBtn = document.getElementById('editFromDetailModalBtn');

      //Referencia al boton en dashboard para agregar motocicleta
      const dashboardAddMotorcycleButton = document.getElementById('dashboardAddMotorcycleButton');

      let currentMotorcyclePlaca = null;

      
      // Referencia al formulario de agregar
      const motorcycleForm = document.getElementById('motorcycleForm');

      // Función para mostrar/ocultar modales
      const showModal = (modalElement) => modalElement.classList.remove('hidden');
      const hideModal = (modalElement) => modalElement.classList.add('hidden');
      const showAlert = (message, isError = false) => {
          // Implementa lógica de alerta
          alert(message);
      };

      // Eventos para el modal de "Agregar Nueva Motocicleta"
      addMotorcycleButton?.addEventListener('click', () => showModal(addMotorcycleModal));
      dashboardAddMotorcycleButton?.addEventListener('click', () => showModal(addMotorcycleModal));
      closeAddMotorcycleModal?.addEventListener('click', () => hideModal(addMotorcycleModal));
      cancelAddMotorcycle?.addEventListener('click', () => {
          hideModal(addMotorcycleModal);
          motorcycleForm.reset();
      });

      // Evento de envío del formulario para "Agregar Nueva Motocicleta"
      motorcycleForm?.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Validación básica de HTML5
        if (!this.checkValidity()) {
          showAlert('Por favor, completa todos los campos requeridos y asegúrate de que el formato sea correcto.', true);
          return;
        }

        // --- INICIO DE CAMBIOS EN EL OBJETO DATA ---
        const data = {
          // 'placa' es el primary key y es NOT NULL, DEBE ser enviado
          placa: this.placa.value,
          // 'marca' del formulario se mapea a 'idmarca' en la DB (asumimos que el input 'marca' contiene el ID)
          marca: this.marca.value,
          // 'modelo' coincide
          modelo: this.modelo.value,
          // 'anio' del formulario se mapea a 'año' en la DB
          anio: this.anio.value,
          // 'kilometraje' del formulario se mapea a 'Motor' en la DB
          kilometraje: this.kilometraje.value,
          // 'idestado' coincide
          idestado: this.idestado.value,
          // 'creadopor' del formulario se mapea a 'creado_por' en la DB
          creado_por: this.creadopor.value,
          
          idagencia: this.idagencia.value || null

          // Agregar otros campos que sean NOT NULL en DB pero no estén en el formulario,
          // dándoles un valor por defecto o nulo si lo permiten.
          // 
          // chasis: null, // o this.chasis.value 
          // idcliente: null,
          // Sucursal: null,
          // color: null,
          // fecha_entrega: null,
          // fecha_renovacion: null,
          // Envio: null,
          // taller: null,
          // iddepartamento: null,
          // idagencia: null,
          // renta_sinIva: null,
          // renta_conIva: null,
          // naf: null,
        };
        // --- FIN DE CAMBIOS EN EL OBJETO DATA ---

        try {
          const response = await fetch('/motocicletas/createViaAjax', { 
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
          });

          const res = await response.json();

          if (!response.ok) {
            const errorMessage = res.messages?.error || res.error || 'Error desconocido al agregar motocicleta.';
            throw new Error(errorMessage);
          }

          showAlert('Motocicleta agregada exitosamente.');
          hideModal(addMotorcycleModal);
          motorcycleForm.reset();
          location.reload(); 

        } catch (error) {
          showAlert(`Error al agregar motocicleta: ${error.message}`, true);
        }
      });

      const populateEditForm = (data) => {
        // campo oculto para la placa
        document.getElementById('editMotorcyclePlacaHidden').value = data.placa;
        // campos del formulario de edición
        document.getElementById('editPlaca').value = data.placa || ''; // Placa es solo lectura
        document.getElementById('editMarca').value = data.idmarca || '';
        document.getElementById('editModelo').value = data.modelo || '';
        document.getElementById('editAnio').value = data.año || '';
        document.getElementById('editMotor').value = data.Motor || '';
        document.getElementById('editEstado').value = data.idestado || '';
        document.getElementById('editChasis').value = data.chasis || '';
        document.getElementById('editIdCliente').value = data.idcliente || '';
        document.getElementById('editColor').value = data.color || '';
        // For date inputs, ensure format is YYYY-MM-DD
        document.getElementById('editFechaEntrega').value = data.fecha_entrega ? data.fecha_entrega.split(' ')[0] : '';
        document.getElementById('editFechaRenovacion').value = data.fecha_renovacion ? data.fecha_renovacion.split(' ')[0] : '';
        document.getElementById('editEnvio').value = data.Envio || '';
        document.getElementById('editTaller').value = data.taller || '';
        document.getElementById('editIdDepartamento').value = data.iddepartamento || '';
        document.getElementById('editRentaSinIva').value = data.renta_sinIva || '';
        document.getElementById('editRentaConIva').value = data.renta_conIva || '';
        document.getElementById('editNAF').value = data.naf || '';
        // ... otros campos
    };

      // VER DETALLES DE MOTOCICLETA

      // Eventos para botones de ver motocicleta
      document.querySelector('table tbody').addEventListener('click', async (event) => {
        const viewButton = event.target.closest('.view-motorcycle');
        if (viewButton) {
            const placa = viewButton.dataset.motorcycleId;
            currentMotorcyclePlaca = placa; 

            try {
                // Hace una solicitud para obtener los detalles de la motocicleta
                  const response = await fetch(`/motocicletas/details/${placa}`, {
                  headers: {
                      'X-Requested-With': 'XMLHttpRequest'
                  }
              });
                const data = await response.json();

                if (response.ok) {
                    // Muestra los detalles en el modal
                    document.getElementById('detailMotorcyclePlaca').textContent = data.placa || 'N/A';
                    document.getElementById('detailMotorcycleMarca').textContent = data.nombre_marca || 'N/A';
                    document.getElementById('detailMotorcycleModelo').textContent = data.modelo || 'N/A';
                    document.getElementById('detailMotorcycleAnio').textContent = data.año || 'N/A'; // Note: 'año'
                    document.getElementById('detailMotorcycleMotor').textContent = data.Motor || 'N/A'; // Note: 'Motor'
                    document.getElementById('detailMotorcycleEstado').textContent = data.nombre_estado || 'N/A';
                    document.getElementById('detailMotorcycleAgencia').textContent = data.nombre_agencia || 'N/A';
                    
                    // Los demas campos
                    document.getElementById('detailMotorcycleChasis').textContent = data.chasis || 'N/A';
                    document.getElementById('detailMotorcycleIdCliente').textContent = data.idcliente || 'N/A';
                    document.getElementById('detailMotorcycleColor').textContent = data.color || 'N/A';
                    document.getElementById('detailMotorcycleFechaEntrega').textContent = data.fecha_entrega || 'N/A';
                    document.getElementById('detailMotorcycleFechaRenovacion').textContent = data.fecha_renovacion || 'N/A';
                    document.getElementById('detailMotorcycleEnvio').textContent = data.Envio || 'N/A';
                    document.getElementById('detailMotorcycleTaller').textContent = data.taller || 'N/A';
                    document.getElementById('detailMotorcycleIdDepartamento').textContent = data.iddepartamento || 'N/A';
                    document.getElementById('detailMotorcycleRentaSinIva').textContent = data.renta_sinIva || 'N/A';
                    document.getElementById('detailMotorcycleRentaConIva').textContent = data.renta_conIva || 'N/A';
                    document.getElementById('detailMotorcycleNAF').textContent = data.naf || 'N/A';

                    // Muestra el modal con los detalles
                    showModal(motorcycleDetailModal);
                } else {
                    // Maneja errores en servidor
                    showAlert(`Error al cargar detalles: ${data.message || 'Error desconocido'}`, true);
                }
            } catch (error) {
                console.error('Error fetching motorcycle details:', error);
                showAlert('Error de conexión al cargar detalles.', true);
            }
        }
    });

    // Evento para cerrar el modal de detalles
    const closeDetailModalBtn = document.getElementById('closeDetailModalBtn'); // Ensure this ID exists in your modal HTML
    closeDetailModalBtn?.addEventListener('click', () => hideModal(motorcycleDetailModal));

    // Evento para cerrar el modal de detalles con la X
    closeDetailModalXBtn?.addEventListener('click', () => {
        hideModal(motorcycleDetailModal);
        currentMotorcyclePlaca = null; // limpiar la placa actual
    });

    // Cerrar el modal de detalles al hacer clic fuera del contenido
    motorcycleDetailModal?.addEventListener('click', (event) => {
        if (event.target === motorcycleDetailModal) {
            hideModal(motorcycleDetailModal);
        }
    });


    document.querySelector('table tbody').addEventListener('click', async (event) => {
        const editButton = event.target.closest('.edit-motorcycle');
        if (editButton) {
            const placa = editButton.dataset.motorcycleId;
            currentMotorcyclePlaca = placa; //Almacena la placa actual para usarla en los modals

            try {
                // Obtener los datos de la motocicleta para editar
                const response = await fetch(`/motocicletas/details/${placa}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();

                if (response.ok) {
                    populateEditForm(data); // Llena el formulario de edición con los datos obtenidos
                    showModal(editMotorcycleModal); // Mostrar el modal de edición
                } else {
                    showAlert(`Error al cargar datos para edición: ${data.message || 'Error desconocido'}`, true);
                }
            } catch (error) {
                console.error('Error fetching data for edit modal from table button:', error);
                showAlert('Error de conexión al cargar datos para edición.', true);
            }
        }
    });


      editFromDetailModalBtn?.addEventListener('click', async () => {
          if (currentMotorcyclePlaca) {
              hideModal(motorcycleDetailModal); // Cierra el modal de detalles antes de abrir el de edición

              try {
                  // Obtiene los datos de la motocicleta para editar
                  const response = await fetch(`/motocicletas/details/${currentMotorcyclePlaca}`, {
                      headers: {
                          'X-Requested-With': 'XMLHttpRequest'
                      }
                  });
                  const data = await response.json();

                  if (response.ok) {
                      populateEditForm(data); // LLena el formulario de edición con los datos obtenidos
                      showModal(editMotorcycleModal); // Muestra el modal de edición
                  } else {
                      showAlert(`Error al cargar datos para edición: ${data.message || 'Error desconocido'}`, true);
                  }
              } catch (error) {
                  console.error('Error fetching data for edit modal:', error);
                  showAlert('Error de conexión al cargar datos para edición.', true);
              }
          } else {
              showAlert('No se ha seleccionado ninguna motocicleta para editar.', true);
          }
      });



    editMotorcycleForm?.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Validación básica de HTML5
        if (!this.checkValidity()) {
            showAlert('Por favor, completa todos los campos requeridos y asegúrate de que el formato sea correcto.', true);
            return;
        }

        const placaToUpdate = document.getElementById('editMotorcyclePlacaHidden').value;
        if (!placaToUpdate) {
            showAlert('No se encontró la placa de la motocicleta para actualizar.', true);
            return;
        }

        // Obtiene los valores de los campos del formulario de edición
        const data = {
            
            idmarca: this.editMarca.value,
            modelo: this.editModelo.value,
            año: this.editAnio.value,
            Motor: this.editMotor.value,
            idestado: this.editEstado.value,
            idagencia: this.editAgencia.value || null,

            chasis: this.editChasis.value || null,
            idcliente: this.editIdCliente.value || null,
            color: this.editColor.value || null,
            fecha_entrega: this.editFechaEntrega.value || null,
            fecha_renovacion: this.editFechaRenovacion.value || null,
            Envio: this.editEnvio.value || null,
            taller: this.editTaller.value || null,
            iddepartamento: this.editIdDepartamento.value || null,
            renta_sinIva: this.editRentaSinIva.value || null,
            renta_conIva: this.editRentaConIva.value || null,
            naf: this.editNAF.value || null,
        };

        try {
            const response = await fetch(`/motocicletas/update/${placaToUpdate}`, {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            });

            const res = await response.json();

            if (!response.ok) {
                const errorMessage = res.messages?.error || res.error || 'Error desconocido al actualizar motocicleta.';
                throw new Error(errorMessage);
            }

            showAlert('Motocicleta actualizada exitosamente.');
            hideModal(editMotorcycleModal);
            location.reload();

        } catch (error) {
            showAlert(`Error al actualizar motocicleta: ${error.message}`, true);
        }
    });
    

        // Cerrar el modal de edición al hacer clic en la X
    closeEditMotorcycleModalXBtn?.addEventListener('click', () => {
          hideModal(editMotorcycleModal);
          // Reset form
          editMotorcycleForm.reset();
      });

    // Cerrar el modal de edición al hacer clic fuera del contenido
    editMotorcycleModal?.addEventListener('click', (event) => {
          if (event.target === editMotorcycleModal) {
              hideModal(editMotorcycleModal);
              // Reset form
              editMotorcycleForm.reset();
          }
      });


      // Eventos para eliminar motocicleta
      document.querySelectorAll('.delete-motorcycle').forEach(button => {
        button.addEventListener('click', async (e) => {
          const motorcycleId = e.currentTarget.dataset.motorcycleId;
          if (!motorcycleId) {
            showAlert('ID de motocicleta no encontrado para eliminar.', true);
            return;
          }

          if (!confirm('¿Estás seguro de que quieres eliminar esta motocicleta? Esta acción es irreversible.')) {
            return;
          }

          try {
            const response = await fetch(`/motocicletas/delete/${motorcycleId}`, {
              method: 'DELETE',
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            });

            const res = await response.json();

            if (!response.ok) {
              const errorMessage = res.messages?.error || res.error || 'Error al eliminar motocicleta.';
              throw new Error(errorMessage);
            }

            showAlert('Motocicleta eliminada exitosamente.');
            location.reload(); 

          } catch (error) {
            showAlert(`Error al eliminar motocicleta: ${error.message}`, true);
          }
        });
      });

      // Eventos para cerrar los modales de detalle y edición
      document.getElementById('closeDetailMotorcycleModalButton')?.addEventListener('click', () => hideModal(motorcycleDetailModal));
      document.getElementById('closeDetailMotorcycleButton')?.addEventListener('click', () => hideModal(motorcycleDetailModal));
      document.getElementById('closeEditMotorcycleModal')?.addEventListener('click', () => hideModal(editMotorcycleModal));
      document.getElementById('cancelEditMotorcycle')?.addEventListener('click', () => hideModal(editMotorcycleModal));

    });
  </script>
</body>

</html>