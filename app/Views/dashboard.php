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
                        secondary: '#AD2E2E'
                    },
                    borderRadius: {
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

<header class="bg-primary text-white p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">MI Renta Total</h1>
        <a href="/logout" class="text-sm text-red-200 hover:text-white">Cerrar sesión</a>
    </div>
</header>

<main class="pt-10 px-4 max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Panel de Control</h2>
        <span class="text-sm text-gray-500"><?= $current_date ?></span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-primaryb text-white p-6 rounded-lg">
            <h3 class="text-lg font-medium mb-2">Valor Total del Inventario</h3>
            <p class="text-3xl font-bold">$<?= number_format($inventory_value, 0, '.', ',') ?></p>
        </div>
        <div class="bg-primaryb text-white p-6 rounded-lg">
            <h3 class="text-lg font-medium mb-2">Motocicletas disponibles</h3>
            <p class="text-3xl font-bold"><?= $available_motorcycles ?></p>
        </div>
        <div class="bg-primaryb text-white p-6 rounded-lg">
            <h3 class="text-lg font-medium mb-2">Motocicletas en renta</h3>
            <p class="text-3xl font-bold"><?= $rented_motorcycles ?></p>
        </div>
        <div class="bg-primaryb text-white p-6 rounded-lg">
            <h3 class="text-lg font-medium mb-2">Alertas de bajo inventario</h3>
            <p class="text-3xl font-bold"><?= $low_inventory_alerts ?></p>
        </div>
        <div class="bg-primaryb text-white p-6 rounded-lg">
            <h3 class="text-lg font-medium mb-2">Órdenes pendientes</h3>
            <p class="text-3xl font-bold"><?= $pending_orders ?></p>
        </div>
        <div class="bg-primaryb text-white p-6 rounded-lg">
            <h3 class="text-lg font-medium mb-2">Mantenimientos pendientes</h3>
            <p class="text-3xl font-bold"><?= $pending_maintenance ?></p>
        </div>
    </div>
</main>

</body>
</html>