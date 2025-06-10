<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MI Renta Total - Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D3850',
                        primaryb: '#0B3C59',
                        grayb: '#E3E8EB',
                        secondary: '#AD2E2E',
                        accent: '#3A86FF'
                    },
                    borderRadius: {
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .nav-btn {
            transition: all 0.3s ease;
        }
        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<script src="<?= base_url('js/user-modal.js') ?>"></script>

<body class="bg-gray-50">
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
                <a href="/usuarios"  
                    class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                    <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                        <i class="ri-user-line"></i>
                    </div>
                    Usuarios
                </a>
                  
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

                        <a href="<?=base_url('logout')?>" class="flex items-center px-4 py-2 text-sm text-red-600 hover:text-white hover:bg-secondary">
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
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Panel de Control</h2>            
        </div>
        <div class="mt-4 md:mt-0 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>
        </div>
    </div>

    <!-- Inventory Section -->
    <section id="inventory-section" class="gap-6 mb-8 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-accent pb-2 inline-block">Inventario</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
        <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-grayb">Valor Total del Inventario</h3>
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-primary">
                        <i class="ri-money-dollar-circle-line ri-xl"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <p class="text-3xl font-bold text-white">$1,248,750</p>
                    <span class="ml-2 text-sm font-medium text-green-600 flex items-center">
                        <i class="ri-arrow-up-s-line"></i>
                        8.2%
                    </span>
                </div>
                 <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/inventario" class="text-white/80 hover:text-white text-sm flex items-center">
                        Ver detalles <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-grayb">Motocicletas disponibles</h3>
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <i class="ri-motorbike-line ri-xl"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <p class="text-3xl font-bold text-white">87</p>
                    <span class="ml-2 text-sm font-medium text-green-600 flex items-center">
                        <i class="ri-arrow-up-s-line"></i>
                        3.5%
                    </span>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/inventario" class="text-white/80 hover:text-white text-sm flex items-center">
                        Administrar inventario <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-grayb">Alertas de bajo inventario</h3>
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                        <i class="ri-alert-line ri-xl"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <p class="text-3xl font-bold text-white">12</p>
                    <span class="ml-2 text-sm font-medium text-red-600 flex items-center">
                        <i class="ri-arrow-up-s-line"></i>
                        4.3%
                    </span>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/inventario" class="text-white/80 hover:text-white text-sm flex items-center">
                        Revisar alertas <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>          
        </div>
    </section>

    <!-- Rentals Section -->
    <section id="rentals-section" class="mb-8 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-primary pb-2 inline-block">Rentas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-grayb">Motocicletas en renta</h3>
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                        <i class="ri-key-line ri-xl"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <p class="text-3xl font-bold text-white">42</p>
                    <span class="ml-2 text-sm font-medium text-red-600 flex items-center">
                        <i class="ri-arrow-down-s-line"></i>
                        2.1%
                    </span>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/rentas" class="text-white/80 hover:text-white text-sm flex items-center">
                        Ver rentas activas <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-grayb">Ordenes pendientes</h3>
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-600">
                        <i class="ri-shopping-cart-line ri-xl"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <p class="text-3xl font-bold text-white">8</p>
                    <span class="ml-2 text-sm font-medium text-green-600 flex items-center">
                        <i class="ri-arrow-down-s-line"></i>
                        1.8%
                    </span>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/rentas" class="text-white/80 hover:text-white text-sm flex items-center">
                        Gestionar órdenes <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>            

        </div>
    </section>

        <!-- Quick Actions Section -->
    <div class="mb-16">
        <h3 class="text-xl font-bold text-gray-900 mb-8">Acciones rápidas</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="/rentas/nueva" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-accent transition-all flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-full mb-3">
                    <i class="ri-add-circle-line text-blue-600 text-2xl"></i>
                </div>
                <span class="font-medium text-gray-800">Nueva renta</span>
            </a>

            <button id="addUserButton"
            
            class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-purple-600 transition-all flex flex-col items-center text-center">
                <div class="bg-purple-100 p-3 rounded-full mb-3">
                    <i class="ri-user-add-line text-purple-600 text-2xl"></i>
                </div>
                <span class="font-medium text-gray-800">Agregar cliente</span>
            
            </button>

            

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

            <a href="/inventario/nuevo" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-green-600 transition-all flex flex-col items-center text-center">
                <div class="bg-green-100 p-3 rounded-full mb-3">
                    <i class="ri-add-box-line text-green-600 text-2xl"></i>
                </div>
                <span class="font-medium text-gray-800">Agregar moto</span>
            </a>
            <a href="/reportes" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-yellow-600 transition-all flex flex-col items-center text-center">
                <div class="bg-yellow-100 p-3 rounded-full mb-3">
                    <i class="ri-file-chart-line text-yellow-600 text-2xl"></i>
                </div>
                <span class="font-medium text-gray-800">Generar reporte</span>
            </a>
        </div>
    </div>

    <!-- Customers Section -->
    <!-- <section id="customers-section" class="mb-16 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-secondary pb-2 inline-block">Clientes</h3>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-medium">Clientes registrados</h4>                   
                </div>
                <div class="bg-secondary/10 p-3 rounded-full">
                    <i class="ri-group-line text-secondary text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="/clientes" class="text-secondary hover:text-red-700 text-sm flex items-center">
                    Administrar clientes <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        </div>
    </section> --> 

    <!-- Reports Section -->
    <!-- <section id="reports-section" class="mb-16 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-secondary pb-2 inline-block">Reportes</h3>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-medium">Generar reportes</h4>
                    <p class="text-gray-600">Visualiza el rendimiento de tu negocio</p>
                </div>
                <div class="bg-grayb p-3 rounded-full">
                    <i class="ri-file-chart-line text-primary text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="/reportes" class="text-secondary hover:text-red-700 text-sm flex items-center">
                    Ver reportes disponibles <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        </div>
    </section>-->

</main>

<script>
    // Smooth scrolling for anchor links

    
    document.addEventListener('DOMContentLoaded', () => {
        const userForm = document.getElementById('userForm');

        if (userForm) {
            userForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const data = {
                name: document.getElementById('name').value.trim(),
                usuario: document.getElementById('usuario').value.trim(),
                password: document.getElementById('password').value,
                email: document.getElementById('email').value.trim(),
                dui: document.getElementById('dui').value.trim(),
                estado: document.getElementById('estado').value,
                role: document.getElementById('role').value
            };

            fetch('/usuarios/ajax-add', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(response => {
                if (response.status === 'ok') {
                alert('Usuario agregado correctamente');
                userForm.reset();
                document.getElementById('addUserModal')?.classList.add('hidden');
                } else {
                alert(response.error || 'Error al agregar usuario.');
                }
            })
            .catch(err => {
                console.error('Error de red o servidor:', err);
                alert('Error al enviar los datos.');
            });
            });
        }
    });



    
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

      

    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

</body>
</html>