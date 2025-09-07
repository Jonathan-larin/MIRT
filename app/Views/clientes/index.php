<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MI Renta Total - Clientes</title>
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
    :where([class^="ri-"])::before {
      content: "\f3c2";
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
  </style>
</head>

<script src="<?= base_url('js/table.js') ?>"></script>
<script src="<?= base_url('js/user-modal.js') ?>"></script>



<body class="bg-white">

  <?php
  $session = session();
  $rol = $session->get('rol');
  $allowedRoles = ['Administrador', 'Jefatura', 'admin'];
  ?>
  <!-- Header -->

  <?= $this->include('partials/header') ?>

  <!--Main-->
  <main class="pt-24 pb-12 px-4 md:px-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-primary">Gestión de Clientes</h1>
      <div class="flex items-center space-x-2">
        <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>

        <?php if (in_array($rol, $allowedRoles)): ?>
        <div class="flex items-center space-x-2">
          <button id="addClientButton"
            class="bg-primary text-white px-4 py-2 rounded-button hover:bg-secondary transition-all duration-200 flex items-center whitespace-nowrap !rounded-button">
            <div class="w-4 h-4 flex items-center justify-center mr-1.5">
              <i class="ri-user-add-line"></i>
            </div>
            Nuevo Cliente
          </button>
        </div>
        <?php endif; ?>
      </div>
    </div>

      <!-- Agregar cliente -->

      <div id="addClientModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-green-600">Agregar Nuevo Cliente</h3>
            <button id="closeAddClientModal" class="text-gray-400 hover:text-gray-700">
              <i class="ri-close-line text-xl"></i>
            </button>
          </div>
          <form id="clientForm" class="space-y-4">
            <div>
              <label for="clientName" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Cliente</label>
              <input type="text" id="clientName" name="Cliente" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-green-500 focus:outline-none" required>
            </div>
            <div>
              <label for="clientCompany" class="block text-sm font-medium text-gray-700 mb-1">Empresa (Opcional)</label>
              <select id="clientCompany" name="idempresa" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-green-500 focus:outline-none">
                <option value="">Seleccionar empresa</option>
                <?php foreach ($empresas as $empresa): ?>
                  <option value="<?= $empresa['idempresa'] ?>"><?= esc($empresa['Empresa']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="flex justify-end space-x-2 pt-2">
              <button type="button" id="cancelAddClient" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-button hover:text-white hover:bg-green-700">Cancelar</button>
              <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-button hover:bg-green-700">Guardar Cliente</button>
            </div>
          </form>
        </div>
      </div>


      <!-- Lista de clientes -->

      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Lista de Clientes</h2>
        <div class="overflow-x-auto">

        <!-- Filtros de búsqueda -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
          <input type="text" id="searchInput" placeholder="Nombre del cliente…"
                class="w-full px-3 py-2 border rounded-button">
          <select id="filterEmpresa" class="w-full px-3 py-2 border rounded-button">
            <option value="">Todas las empresas</option>
            <?php foreach ($empresas as $empresa): ?>
              <option value="<?= esc($empresa['Empresa']) ?>"><?= esc($empresa['Empresa']) ?></option>
            <?php endforeach; ?>
          </select>
          <button id="clearFilters"
                  class="px-4 py-2 bg-gray-100 text-sm font-medium rounded-button hover:text-white hover:bg-secondary">
            <i class="ri-refresh-line mr-1"></i>Limpiar
          </button>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase
                        hover:bg-gray-50" onclick="sortTable(0)">
                <div class="flex items-center">Nombre <i class="ri-arrow-up-down-line ml-1 text-xs"></i></div>
              </th>
              <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase
                        hover:bg-gray-50" onclick="sortTable(1)">
                <div class="flex items-center">Empresa <i class="ri-arrow-up-down-line ml-1 text-xs"></i></div>
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($clientes as $cliente): ?>
              <tr>
                <td class="px-6 py-4 text-sm text-gray-900"><?= esc($cliente['Cliente']) ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= esc($cliente['nombre_empresa'] ?: 'Sin empresa') ?></td>
                <td class="px-6 py-4 text-sm font-medium">
                  <?php if (in_array($rol, $allowedRoles)): ?>
                  <button class="view-client text-primary hover:text-primary/80 mr-3" data-client-id="<?= $cliente['idCliente'] ?>">
                    <i class="ri-eye-line"></i>
                  </button>
                  <button class="edit-client text-blue-600 hover:text-blue-800 mr-3" data-client-id="<?= $cliente['idCliente'] ?>">
                    <i class="ri-edit-line"></i>
                  </button>
                  <button class="delete-client text-red-600 hover:text-red-800" data-client-id="<?= $cliente['idCliente'] ?>">
                    <i class="ri-delete-bin-line"></i>
                  </button>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>



      <!-- Detalles de cliente -->
      <div id="clientDetailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded shadow-xl w-full max-w-md relative">
          <!-- Boton cerrar -->
          <button id="closeDetailModalButton" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
            <i class="ri-close-line text-xl"></i>
          </button>

          <!-- Contenido -->
          <h2 class="text-xl font-bold mb-4 text-primary">Detalles del Cliente</h2>
          <div class="space-y-4 text-sm text-gray-700">
            <div>
              <p class="font-medium text-gray-500">Nombre</p>
              <p id="detailName" class="text-gray-900">—</p>
            </div>
            <div>
              <p class="font-medium text-gray-500">Empresa</p>
              <p id="detailCompany" class="text-gray-900">—</p>
            </div>
          </div>

          <!-- Modal Footer -->
          <div class="flex justify-end space-x-2 mt-6">
            <button id="editClientButton" data-client-id="" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-button hover:text-white hover:bg-secondary">
              Editar
            </button>
            <button id="closeDetailButton" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-button hover:text-white hover:bg-secondary">
              Cerrar
            </button>
          </div>
        </div>
      </div>

      <!-- Editar Cliente -->

      <div id="editClientModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-primary">Editar Cliente</h3>
            <button id="closeEditClientModal" class="text-gray-400 hover:text-gray-700">
              <i class="ri-close-line text-xl"></i>
            </button>
          </div>
          <form id="editClientForm" class="space-y-4">
            <input type="hidden" id="editClientId">

            <div>
              <label for="editClientName" class="block text-sm font-medium text-gray-700">Nombre del Cliente</label>
              <input type="text" id="editClientName" class="w-full px-3 py-2 border rounded-button">
            </div>

            <div>
              <label for="editClientCompany" class="block text-sm font-medium text-gray-700">Empresa</label>
              <select id="editClientCompany" class="w-full px-3 py-2 border rounded-button">
                <option value="">Sin empresa</option>
                <?php foreach ($empresas as $empresa): ?>
                  <option value="<?= $empresa['idempresa'] ?>"><?= esc($empresa['Empresa']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="flex justify-end space-x-2 pt-2">
              <button type="button" id="cancelEditClient" class="px-4 py-2 text-sm bg-gray-100 rounded-button hover:text-white hover:bg-secondary">Cancelar</button>
              <button type="submit" class="px-4 py-2 text-sm bg-primary text-white rounded-button hover:text-white hover:bg-secondary">Guardar</button>
            </div>
          </form>

        </div>
      </div>



  </main>

  <script>

    document.addEventListener('DOMContentLoaded', () => {
      // Client modal functionality
      const addClientButton = document.getElementById('addClientButton');
      const addClientModal = document.getElementById('addClientModal');
      const closeAddClientModal = document.getElementById('closeAddClientModal');
      const cancelAddClient = document.getElementById('cancelAddClient');
      const clientForm = document.getElementById('clientForm');

      addClientButton?.addEventListener('click', () => addClientModal.classList.remove('hidden'));
      closeAddClientModal?.addEventListener('click', () => addClientModal.classList.add('hidden'));
      cancelAddClient?.addEventListener('click', () => addClientModal.classList.add('hidden'));

      clientForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
          Cliente: clientForm.Cliente.value.trim(),
          idempresa: clientForm.idempresa.value || null
        };

        fetch('/clientes/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify(data)
        })
          .then(async response => {
            const res = await response.json();
            if (!response.ok) {
              throw new Error(res.error || 'Error desconocido al crear cliente');
            }

            alert('Cliente agregado exitosamente');
            addClientModal.classList.add('hidden');
            clientForm.reset();
            location.reload();
          })
          .catch(error => {
            alert('Error al agregar cliente: ' + error.message);
          });
      });

      // Action button event handlers
      document.addEventListener('click', function(e) {
        const target = e.target;

        // View client details
        if (target.closest('.view-client')) {
          e.preventDefault();
          const button = target.closest('.view-client');
          const clientId = button.getAttribute('data-client-id');

          fetch(`/clientes/getClient/${clientId}`, {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.Cliente) {
              document.getElementById('detailName').textContent = data.Cliente;
              document.getElementById('detailCompany').textContent = data.nombre_empresa || 'Sin empresa';
              document.getElementById('editClientButton').setAttribute('data-client-id', data.idCliente);
              document.getElementById('clientDetailModal').classList.remove('hidden');
            } else {
              alert('Cliente no encontrado');
            }
          })
          .catch(error => {
            alert('Error al cargar detalles del cliente: ' + error.message);
          });
        }

        // Edit button inside view details modal
        if (target.closest('#editClientButton')) {
          e.preventDefault();
          const button = target.closest('#editClientButton');
          const clientId = button.getAttribute('data-client-id');

          // Close detail modal and open edit modal
          document.getElementById('clientDetailModal').classList.add('hidden');

          // Load client data for editing
          fetch(`/clientes/getClient/${clientId}`, {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.Cliente) {
              document.getElementById('editClientId').value = data.idCliente;
              document.getElementById('editClientName').value = data.Cliente;
              document.getElementById('editClientCompany').value = data.idempresa || '';
              document.getElementById('editClientModal').classList.remove('hidden');
            } else {
              alert('Cliente no encontrado');
            }
          })
          .catch(error => {
            alert('Error al cargar datos del cliente: ' + error.message);
          });
        }
      });

      // Edit client
      document.addEventListener('click', function(e) {
        if (e.target.closest('.edit-client')) {
          const button = e.target.closest('.edit-client');
          const clientId = button.getAttribute('data-client-id');

          fetch(`/clientes/getClient/${clientId}`, {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.Cliente) {
              document.getElementById('editClientId').value = data.idCliente;
              document.getElementById('editClientName').value = data.Cliente;
              document.getElementById('editClientCompany').value = data.idempresa || '';
              document.getElementById('editClientModal').classList.remove('hidden');
            } else {
              alert('Cliente no encontrado');
            }
          })
          .catch(error => {
            alert('Error al cargar datos del cliente');
          });
        }
      });

      // Close modals
      document.getElementById('closeDetailModalButton')?.addEventListener('click', () => {
        document.getElementById('clientDetailModal').classList.add('hidden');
      });

      document.getElementById('closeDetailButton')?.addEventListener('click', () => {
        document.getElementById('clientDetailModal').classList.add('hidden');
      });

      document.getElementById('closeEditClientModal')?.addEventListener('click', () => {
        document.getElementById('editClientModal').classList.add('hidden');
      });

      document.getElementById('cancelEditClient')?.addEventListener('click', () => {
        document.getElementById('editClientModal').classList.add('hidden');
      });

      // Edit client form submission
      document.getElementById('editClientForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        const clientId = document.getElementById('editClientId').value;

        const data = {
          Cliente: document.getElementById('editClientName').value,
          idempresa: document.getElementById('editClientCompany').value || null
        };

        fetch(`/clientes/update/${clientId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify(data)
        })
          .then(async response => {
            const res = await response.json();
            if (!response.ok) throw new Error(res.error || 'Error al actualizar cliente');
            alert('Cliente actualizado correctamente');
            document.getElementById('editClientModal').classList.add('hidden');
            location.reload();
          })
          .catch(err => alert(err.message));
      });

      // Delete client
      document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-client')) {
          const button = e.target.closest('.delete-client');
          const clientId = button.getAttribute('data-client-id');

          if (confirm('¿Está seguro de que desea eliminar este cliente?')) {
            fetch(`/clientes/delete/${clientId}`, {
              method: 'DELETE',
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Cliente eliminado correctamente');
                location.reload();
              } else {
                alert('Error al eliminar cliente');
              }
            })
            .catch(error => {
              alert('Error al eliminar cliente');
            });
          }
        }
      });
    });

    /* Ordenar tabla */
      function sortTable(n) {
        let table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
        table = document.querySelector('table');
        switching = true;
        dir = "asc";
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir === "asc") {
              if (x.textContent.trim().toLowerCase() > y.textContent.trim().toLowerCase()) {
                shouldSwitch = true;
                break;
              }
            } else if (dir === "desc") {
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
            if (switchCount === 0 && dir === "asc") {
              dir = "desc";
              switching = true;
            }
          }
        }
      }

      /* Filtros de tabla */
      function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const empresaFilter = document.getElementById('filterEmpresa').value;

        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
          let showRow = true;
          const nombre = row.cells[0].textContent.trim();
          const empresa = row.cells[1].textContent.trim();

          if (search && !nombre.toLowerCase().includes(search)) showRow = false;
          if (empresaFilter && empresa !== empresaFilter) showRow = false;

          row.style.display = showRow ? '' : 'none';
        });
      }

      document.addEventListener('DOMContentLoaded', () => {
        const inputs = ['searchInput','filterEmpresa'];
        inputs.forEach(id => {
          const el = document.getElementById(id);
          if (el) el.addEventListener('input', filterTable);
        });

        document.getElementById('clearFilters')?.addEventListener('click', () => {
          document.getElementById('searchInput').value = '';
          document.getElementById('filterEmpresa').value = '';
          filterTable();
        });

        /* Orden inicial por defecto (columna 0 Nombre ASC) */
        sortTable(0);
      });


  </script>

  <?= $this->include('partials/notification-js') ?>

</body>

</html>
