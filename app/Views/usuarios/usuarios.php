<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MI Renta Total - Usuarios</title>
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
  <!-- Header -->
  <header class="bg-primary shadow-sm fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center justify-between px-6 py-1">
            
            <div class="flex items-center">
                <img src="<?= base_url('images/logow.png')?>" alt="MIRentaLogo" class="h-10 max-h-10 mr-4">
                <nav class="hidden md:flex items-center space-x-1">
                    
                <a href="dashboarda"
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

                <!--<div class="relative group">
                    <button
                        
                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                        <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                            <i class="ri-tools-line"></i>
                        </div>
                            Mantenimiento                            
                    </button>                        
                </div>

                <div class="relative group">
                    <button

                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                        <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                            <i class="ri-bar-chart-line"></i>
                        </div>
                            Reportes                            
                    </button>                    
                </div>-->


                <button class="relative p-1 text-white hover:text-secondary focus:outline-none">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-notification-3-line"></i>
                    </div>
                   <!-- <span
                    class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>-->
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

  <!--Main-->
  <main class="pt-24 pb-12 px-4 md:px-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-primary">Gestión de Usuarios</h1>
      <div class="flex items-center space-x-2">
        <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>
        
        <button id="addUserButton"
          class="bg-primary text-white px-4 py-2 rounded-button hover:bg-secondary transition-all duration-200 flex items-center whitespace-nowrap !rounded-button">
          <div class="w-4 h-4 flex items-center justify-center mr-1.5">
            <i class="ri-add-line"></i>
          </div>
          Nuevo Usuario
        </button>
      </div>      
    </div>

    <!-- Agregar usuario -->

      <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-primary">Agregar Nuevo Usuario</h3>
            <button id="closeAddUserModal" class="text-gray-400 hover:text-gray-700">
              <i class="ri-close-line text-xl"></i>
            </button>
          </div>
          <form id="userForm" class="space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
              <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none">
            </div>
            <div>
              <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
              <input type="text" id="usuario" name="usuario" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none">
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
              <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none">
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
              <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none">
            </div>
            <div>
              <label for="dui" class="block text-sm font-medium text-gray-700 mb-1">DUI</label>
              <input type="text" id="dui" name="dui" class="w-full px-3 py-2 border border-gray-300 rounded-button focus:ring-primary focus:outline-none" placeholder="00000000-0">
            </div>
            <div>
              <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
              <select id="estado" name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-button">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
              </select>
            </div>
            <div>
              <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
              <select id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-button">
                <option value="Administrador">Administrador</option>
                <option value="Jefatura">Jefatura</option>
                <option value="Operativo">Operativo</option>
                <option value="Visualizador">Visualizador</option>
              </select>
            </div>
            <div class="flex justify-end space-x-2 pt-2">
              <button type="button" id="cancelAddUser" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-button hover:text-white hover:bg-secondary">Cancelar</button>
              <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-button hover:text-white hover:bg-secondary">Guardar</button>
            </div>
          </form>
        </div>
      </div>


      <!-- Lista de usuarios -->
    
      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Lista de Usuarios</h2>
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td class="px-6 py-4 text-sm text-gray-900"><?= esc($usuario['nombre']) ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= esc($usuario['user']) ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= esc($usuario['correo']) ?></td>
                <td class="px-6 py-4 text-sm">
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                    <?= $usuario['rol'] ? esc(ucfirst($usuario['rol'])) : '—' ?>
                  </span>
                </td>
                <td class="px-6 py-4 text-sm">
                  <?php if ($usuario['estado']): ?>
                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Activo</span>
                  <?php else: ?>
                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-sm font-medium">
                  <button class="view-user text-primary hover:text-primary/80 mr-3" data-user-id="<?= $usuario['idUsuario'] ?>">
                    <i class="ri-eye-line"></i>
                  </button>
                  <button class="delete-user text-red-600 hover:text-red-800" data-user-id="<?= $usuario['idUsuario'] ?>">
                    <i class="ri-delete-bin-line"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
        
          

      <!-- Detalles de usuario -->
      <div id="userDetailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded shadow-xl w-full max-w-md relative">
          <!-- Boton cerrar -->
          <button id="closeDetailModalButton" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
            <i class="ri-close-line text-xl"></i>
          </button>

          <!-- Contenido -->
          <h2 class="text-xl font-bold mb-4 text-primary">Detalles del Usuario</h2>
          <div class="space-y-4 text-sm text-gray-700">
            <div>
              <p class="font-medium text-gray-500">Nombre</p>
              <p id="detailName" class="text-gray-900">—</p>
            </div>
            <div>
              <p class="font-medium text-gray-500">Rol</p>
              <span id="detailRole" class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">—</span>
            </div>
            <div>
              <p class="font-medium text-gray-500">Correo</p>
              <p id="detailEmail" class="text-gray-900">—</p>
            </div>
            <div>
              <p class="font-medium text-gray-500">DUI</p>
              <p id="detailPhone" class="text-gray-900">—</p>
            </div>
            <div>
              <p class="font-medium text-gray-500">Última conexión</p>
              <p id="detailLastLogin" class="text-gray-900">—</p>
            </div>
            <div>
              <p class="font-medium text-gray-500">Fecha de registro</p>
              <p id="detailRegistration" class="text-gray-900">—</p>
            </div>
          </div>

          <!-- Modal Footer -->
          <div class="flex justify-end space-x-2 mt-6">
            <button id="editUserButton" data-user-id="" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-button hover:text-white hover:bg-secondary">
              Editar
            </button>
            <button id="closeDetailButton" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-button hover:text-white hover:bg-secondary">
              Cerrar
            </button>
          </div>
        </div>
      </div>

      <!-- Editar Usuario -->
     
      <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-primary">Editar Usuario</h3>
            <button id="closeEditUserModal" class="text-gray-400 hover:text-gray-700">
              <i class="ri-close-line text-xl"></i>
            </button>
          </div>
          <form id="editUserForm" class="space-y-4">
            <input type="hidden" id="editUserId">

            <div>
              <label for="editNombre" class="block text-sm font-medium text-gray-700">Nombre</label>
              <input type="text" id="editNombre" class="w-full px-3 py-2 border rounded-button">
            </div>

            <div>
              <label for="editUsuario" class="block text-sm font-medium text-gray-700">Usuario</label>
              <input type="text" id="editUsuario" class="w-full px-3 py-2 border rounded-button">
            </div>

            <div>
              <label for="editCorreo" class="block text-sm font-medium text-gray-700">Correo</label>
              <input type="email" id="editCorreo" class="w-full px-3 py-2 border rounded-button">
            </div>

            <div>
              <label for="editDui" class="block text-sm font-medium text-gray-700">DUI</label>
              <input type="text" id="editDui" class="w-full px-3 py-2 border rounded-button" placeholder="00000000-0">
            </div>

            <div>
              <label for="editRol" class="block text-sm font-medium text-gray-700">Rol</label>
              <select id="editRol" class="w-full px-3 py-2 border rounded-button">
                <option value="Administrador">Administrador</option>
                <option value="Jefatura">Jefatura</option>
                <option value="Operativo">Operativo</option>
                <option value="Visualizador">Visualizador</option>
              </select>
            </div>

            <div>
              <label for="editEstado" class="block text-sm font-medium text-gray-700">Estado</label>
              <select id="editEstado" class="w-full px-3 py-2 border rounded-button">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>

            <div class="flex justify-end space-x-2 pt-2">
              <button type="button" id="cancelEditUser" class="px-4 py-2 text-sm bg-gray-100 rounded-button hover:text-white hover:bg-secondary">Cancelar</button>
              <button type="submit" class="px-4 py-2 text-sm bg-primary text-white rounded-button hover:text-white hover:bg-secondary">Guardar</button>
            </div>
          </form>

        </div>
      </div>


    
  </main>

  <script>

    document.addEventListener('DOMContentLoaded', () => {
      const addUserButton = document.getElementById('addUserButton');
      const addUserModal = document.getElementById('addUserModal');
      const closeAddUserModal = document.getElementById('closeAddUserModal');
      const cancelAddUser = document.getElementById('cancelAddUser');
      const userForm = document.getElementById('userForm');

      addUserButton?.addEventListener('click', () => addUserModal.classList.remove('hidden'));
      closeAddUserModal?.addEventListener('click', () => addUserModal.classList.add('hidden'));
      cancelAddUser?.addEventListener('click', () => addUserModal.classList.add('hidden'));

      userForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
        name: userForm.name.value,
        usuario: userForm.usuario.value,
        password: userForm.password.value,
        email: userForm.email.value,
        dui: userForm.dui.value,
        estado: userForm.estado.value,
        role: userForm.role.value
        };

        fetch('/usuarios/createViaAjax', {
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
              throw new Error(res.error || 'Error desconocido al crear usuario');
            }

            alert('Usuario agregado exitosamente');
            addUserModal.classList.add('hidden');
            userForm.reset();
            location.reload();
          })
          .catch(error => {
            alert(error.message); // ✅ shows backend error message here
          });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
      const editModal = document.getElementById('editUserModal');
      const detailModal = document.getElementById('userDetailModal');

      document.getElementById('editUserButton')?.addEventListener('click', () => {
        // Fetch values from detail modal
        const userId = document.getElementById('editUserId')?.value || document.querySelector('.view-user[data-user-id]')?.getAttribute('data-user-id');

        const name = document.getElementById('detailName').textContent;
        const email = document.getElementById('detailEmail').textContent;
        const role = document.getElementById('detailRole').textContent;
        const dui = document.getElementById('detailPhone').textContent; // using as DUI here

        document.getElementById('editUserId').value = userId;
        document.getElementById('editNombre').value = name;
        document.getElementById('editCorreo').value = email;
        document.getElementById('editDui').value = dui;

        // Optional: use stored username if displayed somewhere else
        const username = document.querySelector(`.view-user[data-user-id="${userId}"]`)?.closest('tr')?.querySelector('td:nth-child(2)')?.textContent.trim();
        if (username) {
          document.getElementById('editUsuario').value = username;
        }

        document.getElementById('editRol').value = role;
        document.getElementById('editEstado').value = dui === 'Activo' ? '1' : '0'; // adjust if not using phone

        detailModal.classList.add('hidden');
        editModal.classList.remove('hidden');
      });

      document.getElementById('cancelEditUser')?.addEventListener('click', () => {
        editModal.classList.add('hidden');
      });

      document.getElementById('closeEditUserModal')?.addEventListener('click', () => {
        editModal.classList.add('hidden');
      });

      document.getElementById('editUserForm')?.addEventListener('submit', function (e) {
        e.preventDefault();
        const userId = document.getElementById('editUserId').value;

        const data = {
          nombre: document.getElementById('editNombre').value,
          user: document.getElementById('editUsuario').value,
          correo: document.getElementById('editCorreo').value,
          dui: document.getElementById('editDui').value,
          rol: document.getElementById('editRol').value,
          estado: document.getElementById('editEstado').value
        };

        fetch(`/usuarios/update/${userId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify(data)
        })
          .then(async response => {
            const res = await response.json();
            if (!response.ok) throw new Error(res.error || 'Error al actualizar usuario');
            alert('Usuario actualizado correctamente');
            editModal.classList.add('hidden');
            location.reload();
          })
          .catch(err => alert(err.message));
      });
    });
  </script>
</body>

</html>