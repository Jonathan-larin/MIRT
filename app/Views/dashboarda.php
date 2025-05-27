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
<body class="bg-gray-50">

<header class="bg-primary text-white sticky top-0 z-10 shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center py-4">
            <div class="flex items-center mb-4 md:mb-0">
                <i class="ri-motorbike-line text-2xl mr-2"></i>
                <h1 class="text-xl font-bold">MI Renta Total</h1>
            </div>
            
            <nav class="flex flex-wrap justify-center gap-2 md:gap-4">
                <a href="#inventory-section" class="nav-btn bg-accent hover:bg-blue-600 text-white px-4 py-2 rounded-button flex items-center">
                    <i class="ri-stack-line mr-2"></i>
                    <span>Inventario</span>
                </a>
                <a href="#rentals-section" class="nav-btn bg-primaryb hover:bg-primary text-white px-4 py-2 rounded-button flex items-center">
                    <i class="ri-contract-line mr-2"></i>
                    <span>Rentas</span>
                </a>
                <a href="#customers-section" class="nav-btn bg-secondary hover:bg-red-700 text-white px-4 py-2 rounded-button flex items-center">
                    <i class="ri-user-3-line mr-2"></i>
                    <span>Clientes</span>
                </a>
                <a href="#reports-section" class="nav-btn bg-grayb hover:bg-gray-300 text-primary px-4 py-2 rounded-button flex items-center">
                    <i class="ri-line-chart-line mr-2"></i>
                    <span>Reportes</span>
                </a>
                <a href="/logout" class="nav-btn bg-secondary hover:bg-red-700 text-white px-4 py-2 rounded-button flex items-center">
                    <i class="ri-logout-box-r-line mr-2"></i>
                    <span>Salir</span>
                </a>
            </nav>
        </div>
    </div>
</header>

<main class="pt-10 px-4 max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Panel de Control</h2>
            <p class="text-gray-600 mt-1">Resumen general</p>
        </div>
        <div class="mt-4 md:mt-0 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            <span class="text-sm text-gray-700 font-medium"><?= $current_date ?></span>
        </div>
    </div>

    <!-- Inventory Section -->
    <section id="inventory-section" class="mb-16 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-accent pb-2 inline-block">Inventario</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="stat-card bg-primaryb text-white p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium mb-2">Valor Total del Inventario</h3>
                        <p class="text-3xl font-bold">$<?= number_format($inventory_value, 0, '.', ',') ?></p>
                    </div>
                    <i class="ri-money-dollar-circle-line text-3xl opacity-70"></i>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/inventario" class="text-white/80 hover:text-white text-sm flex items-center">
                        Ver detalles <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="stat-card bg-primaryb text-white p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium mb-2">Motocicletas disponibles</h3>
                        <p class="text-3xl font-bold"><?= $available_motorcycles ?></p>
                    </div>
                    <i class="ri-bike-line text-3xl opacity-70"></i>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/inventario" class="text-white/80 hover:text-white text-sm flex items-center">
                        Administrar inventario <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="stat-card bg-primaryb text-white p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium mb-2">Alertas de bajo inventario</h3>
                        <p class="text-3xl font-bold"><?= $low_inventory_alerts ?></p>
                    </div>
                    <i class="ri-alarm-warning-line text-3xl opacity-70"></i>
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
    <section id="rentals-section" class="mb-16 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-primary pb-2 inline-block">Rentas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="stat-card bg-primaryb text-white p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium mb-2">Motocicletas en renta</h3>
                        <p class="text-3xl font-bold"><?= $rented_motorcycles ?></p>
                    </div>
                    <i class="ri-roadster-line text-3xl opacity-70"></i>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <a href="/rentas" class="text-white/80 hover:text-white text-sm flex items-center">
                        Ver rentas activas <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="stat-card bg-primaryb text-white p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium mb-2">Órdenes pendientes</h3>
                        <p class="text-3xl font-bold"><?= $pending_orders ?></p>
                    </div>
                    <i class="ri-timer-line text-3xl opacity-70"></i>
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
        <h3 class="text-xl font-bold text-gray-900 mb-6">Acciones rápidas</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="/rentas/nueva" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-accent transition-all flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-full mb-3">
                    <i class="ri-add-circle-line text-blue-600 text-2xl"></i>
                </div>
                <span class="font-medium text-gray-800">Nueva renta</span>
            </a>
            <a href="/clientes/nuevo" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-purple-600 transition-all flex flex-col items-center text-center">
                <div class="bg-purple-100 p-3 rounded-full mb-3">
                    <i class="ri-user-add-line text-purple-600 text-2xl"></i>
                </div>
                <span class="font-medium text-gray-800">Agregar cliente</span>
            </a>
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
    <section id="customers-section" class="mb-16 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-secondary pb-2 inline-block">Clientes</h3>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-medium">Clientes registrados</h4>
                    <p class="text-gray-600">Total de clientes en tu sistema</p>
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
    </section>

    <!-- Reports Section -->
    <section id="reports-section" class="mb-16 scroll-mt-20">
        <h3 class="text-xl font-bold text-gray-900 mb-6 border-b-2 border-grayb pb-2 inline-block">Reportes</h3>
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
                <a href="/reportes" class="text-primary hover:text-primaryb text-sm flex items-center">
                    Ver reportes disponibles <i class="ri-arrow-right-line ml-1"></i>
                </a>
            </div>
        </div>
    </section>

</main>

<footer class="bg-gray-100 mt-16 py-6 border-t border-gray-200">
    <div class="max-w-6xl mx-auto px-4 text-center text-gray-600 text-sm">
        <p>© <?= date('Y') ?> MI Renta Total. Todos los derechos reservados.</p>
        <div class="flex justify-center space-x-4 mt-2">
            <a href="#" class="hover:text-primary">Términos</a>
            <a href="#" class="hover:text-primary">Privacidad</a>
            <a href="#" class="hover:text-primary">Soporte</a>
        </div>
    </div>
</footer>

<script>
    // Smooth scrolling for anchor links
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