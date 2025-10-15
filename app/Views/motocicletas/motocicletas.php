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

  <?= $this->include('partials/header') ?>

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

      <!-- Filtros de búsqueda -->
      <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
              <input type="text" id="searchInput" placeholder="Placa o modelo..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-primary">
          </div>
          <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
              <select id="filterMarca" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-primary">
                  <option value="">Todas</option>
                  <?php foreach ($marca as $m): ?>
                      <option value="<?= esc($m['marca']) ?>"><?= esc($m['marca']) ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
              <select id="filterEstado" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-primary">
                  <option value="">Todos</option>
                  <?php foreach ($estado as $e): ?>
                      <option value="<?= esc($e['estado']) ?>"><?= esc($e['estado']) ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Agencia</label>
              <select id="filterAgencia" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-primary">
                  <option value="">Todas</option>
                  <?php foreach ($agencia as $a): ?>
                      <option value="<?= esc($a['agencia']) ?>"><?= esc($a['agencia']) ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
      </div>

      <!-- Botón limpiar filtros -->
      <div class="mb-4">
          <button id="clearFilters" class="text-sm text-primary hover:text-secondary">
              <i class="ri-refresh-line mr-1"></i>Limpiar filtros
          </button>
      </div>    

      <h2 class="text-xl font-bold mb-4">Lista de Motocicletas</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase cursor-pointer hover:bg-gray-50"
                  onclick="sortTable(0)">
                <div class="flex items-center justify-between">
                  Marca
                  <i class="ri-arrow-up-down-line text-xs ml-1"></i>
                </div>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase cursor-pointer hover:bg-gray-50"
                  onclick="sortTable(1)">
                <div class="flex items-center justify-between">
                  Placa
                  <i class="ri-arrow-up-down-line text-xs ml-1"></i>
                </div>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase cursor-pointer hover:bg-gray-50"
                  onclick="sortTable(2)">
                <div class="flex items-center justify-between">
                  Año
                  <i class="ri-arrow-up-down-line text-xs ml-1"></i>
                </div>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase cursor-pointer hover:bg-gray-50"
                  onclick="sortTable(3)">
                <div class="flex items-center justify-between">
                  Estado
                  <i class="ri-arrow-up-down-line text-xs ml-1"></i>
                </div>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase cursor-pointer hover:bg-gray-50"
                  onclick="sortTable(4)">
                <div class="flex items-center justify-between">
                  Agencia
                  <i class="ri-arrow-up-down-line text-xs ml-1"></i>
                </div>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($motocicletas)): ?>
              <?php foreach ($motocicletas as $moto): ?>
                <tr data-modelo="<?= esc($moto['modelo']) ?>">
                  <td class="px-6 py-4 text-sm text-gray-900"><?= esc($moto['nombre_marca']) ?></td>
                  <td class="px-6 py-4 text-sm text-gray-500"><?= esc($moto['placa']) ?></td>
                  <td class="px-6 py-4 text-sm text-gray-500">
                    <?= esc($moto['año']) ?>
                    <?php
                      $currentYear = date('Y');
                      $motorcycleAge = $currentYear - $moto['año'];
                      if ($motorcycleAge > 5):
                    ?>
                      <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800" title="Esta motocicleta tiene más de 5 años">
                        <i class="ri-alert-line mr-1"></i>Antigua
                      </span>
                    <?php endif; ?>
                  </td>
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

        <!-- Age Warning Alert -->
        <div id="ageWarningAlert" class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 hidden">
          <div class="flex items-center">
            <i class="ri-alert-line text-xl mr-2"></i>
            <div>
              <p class="font-bold">¡Atención!</p>
              <p>Esta motocicleta tiene más de 5 años. Considere realizar una inspección de mantenimiento adicional.</p>
            </div>
          </div>
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

        <div class="flex justify-end gap-3 pt-4 mt-6 border-t">
          <button id="viewServicesBtn" class="px-6 py-2 bg-gray-200 text-primary rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="ri-tools-line mr-2"></i>Ver Historial
          </button>
          <button id="editFromDetailModalBtn" class="px-6 py-2 bg-gray-200 text-primary rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-blue-500">
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

    <!-- Services Modal -->
    <div id="servicesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden flex justify-center items-center">
      <div class="relative bg-white rounded-lg shadow-xl p-6 w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
          <h3 class="text-2xl font-semibold text-gray-800">Historial</h3>
          <button id="closeServicesModalXBtn" class="text-gray-400 hover:text-gray-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <div class="mb-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <span class="text-sm font-medium text-gray-700">Motocicleta:</span>
              <span id="servicesMotorcycleInfo" class="text-sm text-gray-900 font-medium"></span>
            </div>
            <div class="flex items-center space-x-4">
              <span class="text-sm text-gray-600">Total Servicios:</span>
              <span id="totalServicesCount" class="text-sm font-medium text-primary bg-primary/10 px-2 py-1 rounded">0</span>
            </div>
          </div>
        </div>

        <!-- Services Tabs -->
        <div class="mb-4">
          <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
              <button id="activeServicesTab" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-primary text-primary">
                Servicios Activos
                <span id="activeServicesBadge" class="ml-2 py-0.5 px-2 rounded-full text-xs bg-blue-100 text-blue-800">0</span>
              </button>
              <button id="completedServicesTab" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Servicios Completados
                <span id="completedServicesBadge" class="ml-2 py-0.5 px-2 rounded-full text-xs bg-green-100 text-green-800">0</span>
              </button>
              <button id="rentalHistoryTab" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Historial de Rentas
                <span id="rentalHistoryBadge" class="ml-2 py-0.5 px-2 rounded-full text-xs bg-purple-100 text-purple-800">0</span>
              </button>
            </nav>
          </div>
        </div>

        <!-- Active Services -->
        <div id="activeServicesSection" class="services-section">
          <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center mb-3">
              <i class="ri-tools-line text-blue-600 mr-2"></i>
              <h4 class="text-lg font-medium text-blue-900">Servicios Activos</h4>
            </div>
            <div id="activeServicesList" class="space-y-3">
              <div class="text-center text-gray-500 py-4">
                <i class="ri-loader-4-line animate-spin text-xl"></i>
                <p class="mt-2">Cargando servicios activos...</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Completed Services -->
        <div id="completedServicesSection" class="services-section hidden">
          <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center mb-3">
              <i class="ri-check-circle-line text-green-600 mr-2"></i>
              <h4 class="text-lg font-medium text-green-900">Servicios Completados</h4>
            </div>
            <div id="completedServicesList" class="space-y-3">
              <div class="text-center text-gray-500 py-4">
                <i class="ri-loader-4-line animate-spin text-xl"></i>
                <p class="mt-2">Cargando servicios completados...</p>
              </div>
            </div>
          </div>
        </div>

        
          <!-- Rental History Section -->
          <div id="rentalHistorySection" class="services-section hidden">
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
              <div class="flex items-center mb-3">
                <i class="ri-car-line text-purple-600 mr-2"></i>
                <h4 class="text-lg font-medium text-purple-900">Historial de Rentas</h4>
              </div>
              <div id="rentalHistoryList" class="space-y-3">
                <div class="text-center text-gray-500 py-4">
                  <i class="ri-loader-4-line animate-spin text-xl"></i>
                  <p class="mt-2">Cargando historial de rentas...</p>
                </div>
              </div>
            </div>
          </div>

        <div class="flex justify-end gap-3 pt-4 mt-6 border-t">
          <button id="closeServicesModalBtn" class="px-6 py-2 bg-primary text-white rounded-md hover:text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-gray-400">
            Cerrar
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

        sortTable(0);

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

                    // Check if motorcycle is over 5 years old and show warning
                    const currentYear = new Date().getFullYear();
                    const motorcycleAge = currentYear - parseInt(data.año);
                    const ageWarningAlert = document.getElementById('ageWarningAlert');

                    if (motorcycleAge > 5 && ageWarningAlert) {
                        ageWarningAlert.classList.remove('hidden');
                    } else if (ageWarningAlert) {
                        ageWarningAlert.classList.add('hidden');
                    }

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

      // Services Modal Functionality
      const servicesModal = document.getElementById('servicesModal');
      const viewServicesBtn = document.getElementById('viewServicesBtn');
      const closeServicesModalBtn = document.getElementById('closeServicesModalBtn');
      const closeServicesModalXBtn = document.getElementById('closeServicesModalXBtn');
      const activeServicesTab = document.getElementById('activeServicesTab');
      const completedServicesTab = document.getElementById('completedServicesTab');

      // View Services Button
      viewServicesBtn?.addEventListener('click', () => {
        if (currentMotorcyclePlaca) {
          loadServicesForMotorcycle(currentMotorcyclePlaca);
          showModal(servicesModal);
        } else {
          showAlert('No se ha seleccionado ninguna motocicleta.', true);
        }
      });

      // Close Services Modal
      closeServicesModalBtn?.addEventListener('click', () => hideModal(servicesModal));
      closeServicesModalXBtn?.addEventListener('click', () => hideModal(servicesModal));

      // Services Tabs
      activeServicesTab?.addEventListener('click', () => {
        showActiveServices();
      });

      completedServicesTab?.addEventListener('click', () => {
        showCompletedServices();
      });

      rentalHistoryTab?.addEventListener('click', () => {
        showRentalHistory();
      });

      // Load Services Function
      async function loadServicesForMotorcycle(placa) {
        try {
          const response = await fetch(`/motocicletas/services/${placa}`, {
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          });

          const data = await response.json();

          if (response.ok) {
            displayServices(data);
          } else {
            showAlert(`Error al cargar servicios: ${data.message || 'Error desconocido'}`, true);
          }
        } catch (error) {
          console.error('Error loading services:', error);
          showAlert('Error de conexión al cargar servicios.', true);
        }
      }

      // Display Services Function
      function displayServices(data) {
        const motorcycleInfo = document.getElementById('servicesMotorcycleInfo');
        const totalCount = document.getElementById('totalServicesCount');
        const activeBadge = document.getElementById('activeServicesBadge');
        const completedBadge = document.getElementById('completedServicesBadge');
        const rentalBadge = document.getElementById('rentalHistoryBadge');

        // Update header info
        motorcycleInfo.textContent = `${data.motocicleta?.marca || 'N/A'} ${data.motocicleta?.modelo || 'N/A'} (${data.motocicleta?.placa || 'N/A'})`;
        totalCount.textContent = (data.total_completed + data.total_active) || 0;
        activeBadge.textContent = data.total_active || 0;
        completedBadge.textContent = data.total_completed || 0;
        rentalBadge.textContent = data.total_rentas || 0;

        // Display active services
        displayActiveServices(data.active || []);

        // Display completed services
        displayCompletedServices(data.completed || []);

        // Display rental history
        displayRentalHistory(data.rentas || []);

        // Show active services by default
        showActiveServices();
      }

      // Display Active Services
      function displayActiveServices(services) {
        const container = document.getElementById('activeServicesList');

        if (!services || services.length === 0) {
          container.innerHTML = '<div class="text-center text-gray-500 py-4"><i class="ri-tools-line text-2xl mb-2"></i><p>No hay servicios activos</p></div>';
          return;
        }

        let html = '';
        services.forEach(service => {
          const startDate = new Date(service.fecha_inicio).toLocaleDateString('es-ES');
          const technician = service.tecnico_responsable || 'Pendiente';

          html += `
            <div class="bg-white border border-blue-200 rounded-lg p-4 shadow-sm">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <div class="flex items-center mb-2">
                    <i class="ri-tools-line text-blue-600 mr-2"></i>
                    <h5 class="font-medium text-gray-900">${service.tipo_servicio || 'Servicio'}</h5>
                    <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">${service.estado_servicio || 'Activo'}</span>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-600">
                    <p><span class="font-medium">Técnico:</span> ${technician}</p>
                    <p><span class="font-medium">Fecha Inicio:</span> ${startDate}</p>
                    <p><span class="font-medium">Descripción:</span> ${service.descripcion || 'Sin descripción'}</p>
                    <p><span class="font-medium">Costo Estimado:</span> $${service.costo_estimado ? parseFloat(service.costo_estimado).toFixed(2) : '0.00'}</p>
                    <p><span class="font-medium">Costo Real:</span> $${service.costo_real ? parseFloat(service.costo_real).toFixed(2) : '0.00'}</p>
                  </div>
                </div>
              </div>
            </div>
          `;
        });

        container.innerHTML = html;
      }

      // Display Completed Services
      function displayCompletedServices(services) {
        const container = document.getElementById('completedServicesList');

        if (!services || services.length === 0) {
          container.innerHTML = '<div class="text-center text-gray-500 py-4"><i class="ri-check-circle-line text-2xl mb-2"></i><p>No hay servicios completados</p></div>';
          return;
        }

        let html = '';
        services.forEach(service => {
          const startDate = new Date(service.fecha_inicio).toLocaleDateString('es-ES');
          const completionDate = service.fecha_completado ? new Date(service.fecha_completado).toLocaleDateString('es-ES') : 'N/A';
          const technician = service.tecnico_responsable || 'Pendiente';

          html += `
            <div class="bg-white border border-green-200 rounded-lg p-4 shadow-sm">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <div class="flex items-center mb-2">
                    <i class="ri-check-circle-line text-green-600 mr-2"></i>
                    <h5 class="font-medium text-gray-900">${service.tipo_servicio || 'Servicio'}</h5>
                    <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">${service.estado_servicio || 'Completado'}</span>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-600">
                    <p><span class="font-medium">Técnico:</span> ${technician}</p>
                    <p><span class="font-medium">Fecha Inicio:</span> ${startDate}</p>
                    <p><span class="font-medium">Fecha Completado:</span> ${completionDate}</p>
                    <p><span class="font-medium">Descripción:</span> ${service.descripcion || 'Sin descripción'}</p>
                    <p><span class="font-medium">Costo Estimado:</span> $${service.costo_estimado ? parseFloat(service.costo_estimado).toFixed(2) : '0.00'}</p>
                    <p><span class="font-medium">Costo Real:</span> $${service.costo_real ? parseFloat(service.costo_real).toFixed(2) : '0.00'}</p>
                  </div>
                </div>
              </div>
            </div>
          `;
        });

        container.innerHTML = html;
      }

      // Display Rental History
      function displayRentalHistory(rentas) {
        const container = document.getElementById('rentalHistoryList');

        if (!rentas || rentas.length === 0) {
          container.innerHTML = '<div class="text-center text-gray-500 py-4"><i class="ri-car-line text-2xl mb-2"></i><p>No hay historial de rentas</p></div>';
          return;
        }

        let html = '';
        rentas.forEach(renta => {
          const entregaDate = new Date(renta.fecha_entrega).toLocaleDateString('es-ES');
          const renovacionDate = renta.fecha_renovacion ? new Date(renta.fecha_renovacion).toLocaleDateString('es-ES') : 'N/A';
          const cliente = renta.nombre_cliente || 'Cliente no especificado';

          html += `
            <div class="bg-white border border-purple-200 rounded-lg p-4 shadow-sm">
              <div class="flex items-start">
                <div class="flex-1">
                  <div class="flex items-center mb-2">
                    <i class="ri-car-line text-purple-600 mr-2"></i>
                    <h5 class="font-medium text-gray-900">Renta - ${renta.nombre_marca} ${renta.modelo}</h5>
                    <span class="ml-2 px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded-full">${renta.nombre_estado || 'Renta'}</span>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-600">
                    <p><span class="font-medium">Cliente:</span> ${cliente}</p>
                    <p><span class="font-medium">Fecha Entrega:</span> ${entregaDate}</p>
                    <p><span class="font-medium">Fecha Renovación:</span> ${renovacionDate}</p>
                    <p><span class="font-medium">Renta sin IVA:</span> $${renta.renta_sinIva ? parseFloat(renta.renta_sinIva).toFixed(2) : '0.00'}</p>
                    <p><span class="font-medium">Renta con IVA:</span> $${renta.renta_conIva ? parseFloat(renta.renta_conIva).toFixed(2) : '0.00'}</p>
                    <p><span class="font-medium">Agencia:</span> ${renta.nombre_agencia || 'N/A'}</p>
                  </div>
                </div>
              </div>
            </div>
          `;
        });

        container.innerHTML = html;
      }

      // Tab switching functions
      function showActiveServices() {
        document.getElementById('activeServicesSection').classList.remove('hidden');
        document.getElementById('completedServicesSection').classList.add('hidden');
        document.getElementById('rentalHistorySection').classList.add('hidden');
        activeServicesTab.classList.add('border-primary', 'text-primary');
        activeServicesTab.classList.remove('border-transparent', 'text-gray-500');
        completedServicesTab.classList.remove('border-primary', 'text-primary');
        completedServicesTab.classList.add('border-transparent', 'text-gray-500');
        rentalHistoryTab.classList.remove('border-primary', 'text-primary');
        rentalHistoryTab.classList.add('border-transparent', 'text-gray-500');
      }

      function showCompletedServices() {
        document.getElementById('activeServicesSection').classList.add('hidden');
        document.getElementById('completedServicesSection').classList.remove('hidden');
        document.getElementById('rentalHistorySection').classList.add('hidden');
        completedServicesTab.classList.add('border-primary', 'text-primary');
        completedServicesTab.classList.remove('border-transparent', 'text-gray-500');
        activeServicesTab.classList.remove('border-primary', 'text-primary');
        activeServicesTab.classList.add('border-transparent', 'text-gray-500');
        rentalHistoryTab.classList.remove('border-primary', 'text-primary');
        rentalHistoryTab.classList.add('border-transparent', 'text-gray-500');
      }

      function showRentalHistory() {
        document.getElementById('activeServicesSection').classList.add('hidden');
        document.getElementById('completedServicesSection').classList.add('hidden');
        document.getElementById('rentalHistorySection').classList.remove('hidden');
        rentalHistoryTab.classList.add('border-primary', 'text-primary');
        rentalHistoryTab.classList.remove('border-transparent', 'text-gray-500');
        activeServicesTab.classList.remove('border-primary', 'text-primary');
        activeServicesTab.classList.add('border-transparent', 'text-gray-500');
        completedServicesTab.classList.remove('border-primary', 'text-primary');
        completedServicesTab.classList.add('border-transparent', 'text-gray-500');
      }

    });

  // Función para filtrar la tabla
    function filterTable() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const marcaValue = document.getElementById('filterMarca').value;
        const estadoValue = document.getElementById('filterEstado').value;
        const agenciaValue = document.getElementById('filterAgencia').value;
        
        const rows = document.querySelectorAll('table tbody tr');
        
        rows.forEach(row => {
            let showRow = true;
            
            // Buscar en PLACA Y MODELO
            // Columnas: 0-Marca, 1-Placa, 2-Año, 3-Estado, 4-Agencia, 5-Acciones
            const marcaCell = row.cells[0]?.textContent.trim() || '';
            const placaCell = row.cells[1]?.textContent.trim() || '';
            const placa = row.querySelector('[data-motorcycle-id]')?.dataset.motorcycleId.toLowerCase() || '';
            const modelo = row.dataset.modelo?.toLowerCase() || '';

            if (searchValue &&
                !placaCell.toLowerCase().includes(searchValue) &&
                !placa.includes(searchValue) &&
                !modelo.includes(searchValue)) {
                showRow = false;
            }
            
            // Filtrar por MARCA (usando la columna 0)
            if (marcaValue && marcaCell !== marcaValue) {
                showRow = false;
            }
            
            // Filtrar por ESTADO (usando la columna 3 - el span dentro)
            const estadoSpan = row.cells[3]?.querySelector('span') || row.cells[3];
            const estadoText = estadoSpan?.textContent.trim() || '';
            if (estadoValue && estadoText !== estadoValue) {
                showRow = false;
            }
            
            // Filtrar por AGENCIA (usando la columna 4)
            const agenciaCell = row.cells[4]?.textContent.trim() || '';
            if (agenciaValue && agenciaCell !== agenciaValue) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }

    // Evento de limpiar filtros
    document.getElementById('clearFilters')?.addEventListener('click', function() {
        if(document.getElementById('searchInput')) document.getElementById('searchInput').value = '';
        if(document.getElementById('filterMarca')) document.getElementById('filterMarca').value = '';
        if(document.getElementById('filterEstado')) document.getElementById('filterEstado').value = '';
        if(document.getElementById('filterAgencia')) document.getElementById('filterAgencia').value = '';        
        filterTable();
    });

    // Asegúrarse de que los elementos existan antes de agregar listeners
    document.addEventListener('DOMContentLoaded', function() {
        const elements = ['searchInput', 'filterMarca', 'filterEstado', 'filterAgencia'];
        elements.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('input', filterTable);
                if (element.tagName === 'SELECT') {
                    element.addEventListener('change', filterTable);
                }
            }
        });

        //Ordenar tabla por marca ascendente de manera predeterminada

        sortTable(0);
    });

    // Ordenar tabla en orden ascendente o descendente segun una columna de manera dinamica
    function sortTable(n) {
        let table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
        table = document.querySelector('table');
        switching = true;
        dir = "asc";
        
        while (switching) {
            switching = false;
            rows = table.rows;
            
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                
                if (dir == "asc") {
                    if (x.textContent.trim().toLowerCase() > y.textContent.trim().toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.textContent.trim().toLowerCase() < y.textContent.trim().toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchCount++;
            } else {
                if (switchCount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
  </script>

  <?= $this->include('partials/notification-js') ?>

</body>

</html>
