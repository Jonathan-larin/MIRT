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

<body class="bg-white">
  <!-- Header -->
  <header class="bg-primary shadow-sm fixed top-0 left-0 right-0 z-50">

    <!-- PROBANDO -->
    <div class="flex items-center justify-between px-6 py-1">
      
        <div class="flex items-center">
                <img src="images/logow.png" alt="MIRentaLogo" class="h-10 max-h-10 mr-4">
                <nav class="hidden md:flex items-center space-x-1">
                    
                <a href="dashboarda"
                class="flex items-center px-3 py-2 text-sm font-medium text-white bg-secondary rounded">
                    <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                        <i class="ri-dashboard-line"></i>
                    </div>
                    Panel de Control
                </a>
                    
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
                        <a href="/inventario"
                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                            <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                                <i class="ri-stack-line"></i>
                            </div>
                            Inventario
                        </a>                        
                    </button> 
                </div>
                    
                <div class="relative group">
                    <button>
                        <a href="/clientes"
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
        

                </nav>                
            </div>

        <div class="flex items-center space-x-4">
                <button class="relative p-1 text-white hover:text-secondary focus:outline-none">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-notification-3-line"></i>
                    </div>
                    <span
                        class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                </button>
                <div class="relative group">
                    <button class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-white">
                            <i class="ri-user-line"></i>
                        </div>
                        <span class="text-sm font-medium text-white hidden md:block">Admin</span>
                        <div class="w-4 h-4 flex items-center justify-center">
                            <i class="ri-arrow-down-s-line"></i>
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

                        <a href="login.html" class="flex items-center px-4 py-2 text-sm text-red-600 hover:text-white hover:bg-secondary">
                            <div class="w-4 h-4 flex items-center justify-center mr-2">
                                <i class="ri-logout-box-r-line"></i>
                            </div>
                            Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <!-- Mobile menu button -->
    <div class="md:hidden px-4 pb-4">
      <button id="mobileMenuButton"
        class="flex items-center px-3 py-2 border border-gray-300 rounded text-gray-700 hover:text-primary hover:border-primary whitespace-nowrap !rounded-button">
        <div class="w-5 h-5 flex items-center justify-center mr-1">
          <i class="ri-menu-line"></i>
        </div>
        Menu
      </button>
    </div>
    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden px-4 pb-4">
      <nav class="flex flex-col space-y-2">
        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded">
          <div class="w-5 h-5 flex items-center justify-center mr-1.5">
            <i class="ri-dashboard-line"></i>
          </div>
          Dashboard
        </a>
        <div class="mobile-dropdown">
          <button
            class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-primary bg-blue-50 rounded whitespace-nowrap !rounded-button">
            <div class="flex items-center">
              <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                <i class="ri-user-line"></i>
              </div>
              Usuarios
            </div>
            <div class="w-4 h-4 flex items-center justify-center">
              <i class="ri-arrow-down-s-line"></i>
            </div>
          </button>
          <div class="hidden pl-8 mt-1 space-y-1">
            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Catálogo</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Categorías</a>
            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Nueva Lista</a>
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
        <span class="text-sm text-gray-500">27 de Mayo, 2025</span>
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
    <div id="addUserModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="flex items-center justify-between p-4 border-b">
          <h3 class="text-lg font-medium text-gray-900">Agregar Nuevo Usuario</h3>
          <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
            <i class="ri-close-line ri-lg"></i>
          </button>
        </div>
        <div class="p-6">
          <form id="userForm">
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
              <input type="text" id="name" name="name"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
            </div>

            <div class="mb-4">
              <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
              <input type="text" id="usuario" name="usuario"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
            </div>

            <div class="mb-4">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
              <input type="password" id="password" name="password"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
            </div>

            
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
              <input type="email" id="email" name="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
            </div>
            <div class="mb-4">
              <label for="dui" class="block text-sm font-medium text-gray-700 mb-1">DUI</label>
              <input type="text" id="dui" name="dui"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
            </div>

            <div class="mb-4">
              <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
              <select id="estado" name="estado"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>                
              </select>
            </div>


            <div class="mb-4">
              <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
              <select id="role" name="role"
                class="w-full px-3 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary">
                <option value="Administrador">Administrador</option>
                <option value="Jefatura">Jefatura</option>
                <option value="Operativo">Operativo</option>
                <option value="Visualizador">Visualizador</option>
              </select>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
              <button type="button" id="cancelAddUser"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-button hover:text-white hover:bg-secondary">Cancelar</button>
              <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-button hover:text-white hover:bg-secondary">Guardar
                Usuario</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Detalle de usuarios -->
    <div id="userDetailModal"
      class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="flex items-center justify-between p-4 border-b">
          <h3 class="text-lg font-medium text-gray-900">Detalles del Usuario</h3>
          <button id="closeDetailModalButton" class="text-gray-500 hover:text-gray-700">
            <i class="ri-close-line ri-lg"></i>
          </button>
        </div>
        <div class="p-6">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-primary text-2xl">
              <i class="ri-user-line"></i>
            </div>
            <div class="ml-4">
              <h4 id="detailName" class="text-xl font-semibold text-gray-900">Carlos Mendoza</h4>
              <span id="detailRole"
                class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Administrador</span>
            </div>
          </div>
          <div class="space-y-4">
            <div>
              <p class="text-sm font-medium text-gray-500">Correo Electrónico</p>
              <p id="detailEmail" class="text-sm text-gray-900">carlos.mendoza@empresa.com</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-500">Teléfono</p>
              <p id="detailPhone" class="text-sm text-gray-900">+52 55 1234 5678</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-500">Última Conexión</p>
              <p id="detailLastLogin" class="text-sm text-gray-900">Hoy a las 10:45 AM</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-500">Fecha de Registro</p>
              <p id="detailRegistration" class="text-sm text-gray-900">15 de Enero, 2024</p>
            </div>
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button id="editUserButton"
              class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-button hover:bg-primary/90">Editar</button>
            <button id="closeDetailButton"
              class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-button hover:bg-gray-200">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100 mb-8">
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-medium text-white">Lista de Usuarios</h3>
        <div class="relative">
          <input type="text" placeholder="Buscar usuario..."
            class="pl-8 pr-4 py-2 border border-gray-300 rounded-button focus:outline-none focus:ring-1 focus:ring-primary text-sm">
          <div class="absolute left-3 top-2.5 text-gray-400">
            <i class="ri-search-line"></i>
          </div>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-grayb uppercase tracking-wider">Usuario</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-grayb uppercase tracking-wider">Correo</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-grayb uppercase tracking-wider">Rol</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-grayb uppercase tracking-wider">Última Conexión
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-grayb uppercase tracking-wider">Estado</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-grayb uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-primary">
                    <i class="ri-user-line"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Carlos Mendoza</div>
                    <div class="text-sm text-gray-500">carlos.mendoza</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">carlos.mendoza@empresa.com</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Administrador</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Hoy a las 10:45 AM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Activo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="view-user text-primary hover:text-primary/80 mr-3" data-user-id="1">
                  <i class="ri-eye-line"></i>
                </button>
                <button class="delete-user text-red-600 hover:text-red-800" data-user-id="1">
                  <i class="ri-delete-bin-line"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                    <i class="ri-user-line"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Ana López</div>
                    <div class="text-sm text-gray-500">ana.lopez</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ana.lopez@empresa.com</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Jefatura</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ayer a las 3:20 PM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Activo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="view-user text-primary hover:text-primary/80 mr-3" data-user-id="2">
                  <i class="ri-eye-line"></i>
                </button>
                <button class="delete-user text-red-600 hover:text-red-800" data-user-id="2">
                  <i class="ri-delete-bin-line"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <i class="ri-user-line"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Juan Pérez</div>
                    <div class="text-sm text-gray-500">juan.perez</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">juan.perez@empresa.com</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Operativo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mayo 17, 2025 a las 4:30 PM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Activo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="view-user text-primary hover:text-primary/80 mr-3" data-user-id="3">
                  <i class="ri-eye-line"></i>
                </button>
                <button class="delete-user text-red-600 hover:text-red-800" data-user-id="3">
                  <i class="ri-delete-bin-line"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600">
                    <i class="ri-user-line"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">María García</div>
                    <div class="text-sm text-gray-500">maria.garcia</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">maria.garcia@empresa.com</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Visualizador</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mayo 16, 2025 a las 11:10 AM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Activo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="view-user text-primary hover:text-primary/80 mr-3" data-user-id="4">
                  <i class="ri-eye-line"></i>
                </button>
                <button class="delete-user text-red-600 hover:text-red-800" data-user-id="4">
                  <i class="ri-delete-bin-line"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600">
                    <i class="ri-user-line"></i>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Luis Hernández</div>
                    <div class="text-sm text-gray-500">luis.hernandez</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">luis.hernandez@empresa.com</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Operativo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mayo 15, 2025 a las 9:00 AM</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactivo</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="view-user text-primary hover:text-primary/80 mr-3" data-user-id="5">
                  <i class="ri-eye-line"></i>
                </button>
                <button class="delete-user text-red-600 hover:text-red-800" data-user-id="5">
                  <i class="ri-delete-bin-line"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex items-center justify-between mt-4">
        <div class="text-sm text-grayb">
          Mostrando <span class="font-medium">1</span> a <span class="font-medium">5</span> de <span
            class="font-medium">12</span> resultados
        </div>
        <div class="flex space-x-2">
          <button
            class="px-3 py-1 border border-gray-300 rounded-button text-sm text-grayb hover:bg-secondary">Anterior</button>
          <button
            class="px-3 py-1 border border-gray-300 rounded-button text-sm text-white bg-secondary hover:bg-secondary">1</button>
          <button
            class="px-3 py-1 border border-gray-300 rounded-button text-sm text-grayb hover:bg-secondary">2</button>
          <button
            class="px-3 py-1 border border-gray-300 rounded-button text-sm text-grayb hover:bg-secondary">3</button>
          <button
            class="px-3 py-1 border border-gray-300 rounded-button text-sm text-grayb hover:bg-secondary">Siguiente</button>
        </div>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Mobile menu toggle
      const mobileMenuButton = document.getElementById('mobileMenuButton');
      const mobileMenu = document.getElementById('mobileMenu');
      if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function () {
          mobileMenu.classList.toggle('hidden');
        });
      }

      // Mobile dropdowns
      const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');
      mobileDropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const content = dropdown.querySelector('div');
        if (button && content) {
          button.addEventListener('click', function () {
            content.classList.toggle('hidden');
            const icon = button.querySelector('i.ri-arrow-down-s-line');
            if (icon) {
              icon.classList.toggle('ri-arrow-down-s-line');
              icon.classList.toggle('ri-arrow-up-s-line');
            }
          });
        }
      });

      // Agregar usuario modal
      const addUserButton = document.getElementById('addUserButton');
      const addUserModal = document.getElementById('addUserModal');
      const closeModalButton = document.getElementById('closeModalButton');
      const cancelAddUser = document.getElementById('cancelAddUser');
      const userForm = document.getElementById('userForm');

      if (addUserButton && addUserModal) {
        addUserButton.addEventListener('click', function () {
          addUserModal.classList.remove('hidden');
        });
      }

      if (closeModalButton && addUserModal) {
        closeModalButton.addEventListener('click', function () {
          addUserModal.classList.add('hidden');
        });
      }

      if (cancelAddUser && addUserModal) {
        cancelAddUser.addEventListener('click', function () {
          addUserModal.classList.add('hidden');
        });
      }

      if (userForm) {
        userForm.addEventListener('submit', function (e) {
          e.preventDefault();
          // Enviar datos a base de datos
          alert('Usuario agregado exitosamente!');
          addUserModal.classList.add('hidden');
          userForm.reset();
        });
      }

      // User Detail Modal
      const viewUserButtons = document.querySelectorAll('.view-user');
      const userDetailModal = document.getElementById('userDetailModal');
      const closeDetailModalButton = document.getElementById('closeDetailModalButton');
      const closeDetailButton = document.getElementById('closeDetailButton');

      // Ejemplos de datos de usuario (esto debería venir de una DB)
      const users = [
        {
          id: 1,
          name: 'Carlos Mendoza',
          email: 'carlos.mendoza@empresa.com',
          phone: '+52 55 1234 5678',
          role: 'Administrador',
          lastLogin: 'Hoy a las 10:45 AM',
          registration: '15 de Enero, 2024',
          status: 'Activo'
        },
        {
          id: 2,
          name: 'Ana López',
          email: 'ana.lopez@empresa.com',
          phone: '+52 55 9876 5432',
          role: 'Jefatura',
          lastLogin: 'Ayer a las 3:20 PM',
          registration: '20 de Febrero, 2024',
          status: 'Activo'
        },
        {
          id: 3,
          name: 'Juan Pérez',
          email: 'juan.perez@empresa.com',
          phone: '+52 55 8765 4321',
          role: 'Operativo',
          lastLogin: 'Mayo 17, 2025 a las 4:30 PM',
          registration: '5 de Marzo, 2024',
          status: 'Activo'
        },
        {
          id: 4,
          name: 'María García',
          email: 'maria.garcia@empresa.com',
          phone: '+52 55 7654 3210',
          role: 'Visualizador',
          lastLogin: 'Mayo 16, 2025 a las 11:10 AM',
          registration: '12 de Abril, 2024',
          status: 'Activo'
        },
        {
          id: 5,
          name: 'Luis Hernández',
          email: 'luis.hernandez@empresa.com',
          phone: '+52 55 6543 2109',
          role: 'Operativo',
          lastLogin: 'Mayo 15, 2025 a las 9:00 AM',
          registration: '25 de Mayo, 2024',
          status: 'Inactivo'
        }
      ];

      viewUserButtons.forEach(button => {
        button.addEventListener('click', function () {
          const userId = parseInt(this.getAttribute('data-user-id'));
          const user = users.find(u => u.id === userId);

          if (user) {
            document.getElementById('detailName').textContent = user.name;
            document.getElementById('detailRole').textContent = user.role;
            document.getElementById('detailEmail').textContent = user.email;
            document.getElementById('detailPhone').textContent = user.phone;
            document.getElementById('detailLastLogin').textContent = user.lastLogin;
            document.getElementById('detailRegistration').textContent = user.registration;

            // Basado en el rol, cambiar el color del badge
            const roleBadge = document.getElementById('detailRole');
            roleBadge.className = 'inline-block px-2 py-1 text-xs font-medium rounded-full';

            if (user.role === 'Administrador') {
              roleBadge.classList.add('bg-blue-100', 'text-blue-800');
            } else if (user.role === 'Jefatura') {
              roleBadge.classList.add('bg-purple-100', 'text-purple-800');
            } else if (user.role === 'Operativo') {
              roleBadge.classList.add('bg-green-100', 'text-green-800');
            } else {
              roleBadge.classList.add('bg-yellow-100', 'text-yellow-800');
            }

            userDetailModal.classList.remove('hidden');
          }
        });
      });

      if (closeDetailModalButton && userDetailModal) {
        closeDetailModalButton.addEventListener('click', function () {
          userDetailModal.classList.add('hidden');
        });
      }

      if (closeDetailButton && userDetailModal) {
        closeDetailButton.addEventListener('click', function () {
          userDetailModal.classList.add('hidden');
        });
      }

      // Borrar usuario
      const deleteUserButtons = document.querySelectorAll('.delete-user');

      deleteUserButtons.forEach(button => {
        button.addEventListener('click', function () {
          const userId = this.getAttribute('data-user-id');
          if (confirm('¿Estás seguro que deseas eliminar este usuario?')) {
            // Solicitar al backend la eliminación del usuario
            alert(`Usuario con ID ${userId} eliminado exitosamente!`);
            // Refrezcar para actualizar la lista de usuarios
          }
        });
      });

      // Editar usuario
      const editUserButton = document.getElementById('editUserButton');

      if (editUserButton) {
        editUserButton.addEventListener('click', function () {
          alert('Funcionalidad de edición de usuario se implementará aquí');
          // Abrir ventana de edición de usuario
        });
      }
    });
  </script>
</body>

</html>