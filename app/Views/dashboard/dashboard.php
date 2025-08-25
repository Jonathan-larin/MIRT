<!DOCTYPE html>
<html lang="en">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #AD2E2E;
        }
    </style>
</head>

<body class="bg-gray-50">
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
                </button>
                <div class="relative group">
                    <button class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-white">
                            <i class="ri-user-line"></i>
                        </div>
                        <span class="text-sm font-medium text-white hidden md:block">
                            <?php
                            $session = session();
                            // Obtiene el nombre del usuario de la sesión
                            echo esc($session->get('nombre') ?: 'Invitado');
                            ?>
                        </span>
                        <div class="w-4 h-4 flex items-center justify-center">
                            <i class="ri-arrow-down-s-line" style="color: white;"></i>
                        </div>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        
                        <a href="/profile"
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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Panel de Control</h1>
            <div class="flex items-center space-x-2">
                <div class="mt-4 md:mt-0 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                    <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>
                </div>
                <!-- <button
                    class="bg-primaryb text-white px-4 py-2 rounded-button hover:bg-secondary transition-all duration-200 flex items-center whitespace-nowrap !rounded-button">
                    <div class="w-4 h-4 flex items-center justify-center mr-1.5">
                        <i class="ri-add-line"></i>
                    </div>
                    Nueva Entrada
                </button> -->
            </div>
        </div>

        <section id="space-section" class="mb-16 scroll-mt-20">
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
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
                <p class="text-sm text-gray-500 mt-1">Desde el mes anterior</p>
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
                <p class="text-sm text-gray-500 mt-1">Desde el mes anterior</p>
            </div>

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
                <p class="text-sm text-gray-500 mt-1">Desde el mes anterior</p>
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
                <p class="text-sm text-gray-500 mt-1">Necesitan nueva orden</p>
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
                <p class="text-sm text-gray-500 mt-1">Esperando entrega</p>
            </div>

            <div class="bg-primaryb p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-grayb">Mantenimientos pendientes</h3>
                    <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-600">
                        <i class="ri-tools-line ri-xl"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <p class="text-3xl font-bold text-white">15</p>
                    <span class="ml-2 text-sm font-medium text-red-600 flex items-center">
                        <i class="ri-arrow-up-s-line"></i>
                        5.7%
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-1">Programados en los siguientes 7 dias</p>
            </div>
        </div>
    

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
            });
        </script>
    </main>
</body>

</html>
