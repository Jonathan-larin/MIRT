<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MI Renta Total - Reportes</title>
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
                    <button class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                        <div class="flex items-center mr-1.5">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-motorbike-line"></i>
                            </div>
                            Motocicletas
                        </div>
                        <div class="w-4 h-4 flex items-center justify-center">
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="/motocicletas" class="flex items-center px-4 py-2 text-sm text-primary hover:text-white hover:bg-secondary">
                            <div class="w-4 h-4 flex items-center justify-center mr-2">
                                <i class="ri-motorbike-line"></i>
                            </div>
                            Ver Motocicletas
                        </a>
                        <a href="/servicios" class="flex items-center px-4 py-2 text-sm text-primary hover:text-white hover:bg-secondary">
                            <div class="w-4 h-4 flex items-center justify-center mr-2">
                                <i class="ri-tools-line"></i>
                            </div>
                            Servicios
                        </a>
                        <a href="/rentas" class="flex items-center px-4 py-2 text-sm text-primary hover:text-white hover:bg-secondary">
                            <div class="w-4 h-4 flex items-center justify-center mr-2">
                                <i class="ri-calendar-check-line"></i>
                            </div>
                            Rentas
                        </a>
                    </div>
                </div>

                <div class="relative group">
                    <button>
                        <a href="/reportes"
                        class="flex items-center px-3 py-2 text-sm font-medium text-white hover:text-white hover:bg-secondary rounded whitespace-nowrap !rounded-button">
                            <div class="w-5 h-5 flex items-center justify-center mr-1.5">
                                <i class="ri-bar-chart-line"></i>
                            </div>
                            Reportes
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
                <a href="dashboard" class="flex items-center px-3 py-2 text-sm font-medium text-primary bg-blue-50 rounded">
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
      <h1 class="text-2xl font-bold text-primary">Sistema de Reportes</h1>
      <div class="flex items-center space-x-2">
        <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>

        <button id="generateReportButton"
          class="bg-primary text-white px-4 py-2 rounded-button hover:bg-secondary transition-all duration-200 flex items-center whitespace-nowrap !rounded-button">
          <div class="w-4 h-4 flex items-center justify-center mr-1.5">
            <i class="ri-file-chart-line"></i>
          </div>
          Generar Reporte
        </button>
      </div>
    </div>

    <div class="bg-white p-6 rounded shadow">
      <div class="text-center py-12">
        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="ri-bar-chart-line text-3xl text-primary"></i>
        </div>
        <h3 class="text-lg font-semibold text-primary mb-2">Sistema de Reportes</h3>
        <p class="text-gray-600 mb-6">Aquí podrás generar y visualizar reportes detallados del sistema.</p>
        <p class="text-sm text-gray-500">Funcionalidad próximamente disponible</p>
      </div>
    </div>

  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Mobile menu functionality
      const mobileMenuButton = document.getElementById('mobileMenuButton');
      const mobileMenu = document.getElementById('mobileMenu');

      mobileMenuButton?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });

      // Close mobile menu when clicking outside
      document.addEventListener('click', (e) => {
        if (!mobileMenuButton?.contains(e.target) && !mobileMenu?.contains(e.target)) {
          mobileMenu?.classList.add('hidden');
        }
      });
    });
  </script>

</body>

</html>
