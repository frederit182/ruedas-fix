<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Ruedas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-4">
        <h1 class="text-xl font-bold mb-6">⚙️ Control Ruedas</h1>

        <nav class="space-y-3">
    <a href="/" class="block hover:bg-gray-700 p-2 rounded">🏠 Dashboard</a>

    <a href="{{ route('inventario.index') }}" class="block hover:bg-gray-700 p-2 rounded">
        📦 Inventario de Ruedas
    </a>

    <a href="{{ route('clientes.create') }}" class="block hover:bg-gray-700 p-2 rounded">
        👥 Clientes
    </a>

    <a href="{{ route('clientes.index') }}" class="block hover:bg-gray-700 p-2 rounded">
        📋 Historial
    </a>

    <a href="{{ route('consumo.index') }}" class="block hover:bg-gray-700 p-2 rounded">
        🔧 Consumo de Ruedas
    </a>
</nav>

    </aside>

    <!-- Contenido -->
    <div class="flex-1">

        <!-- Navbar -->
        <header class="bg-blue-600 text-white p-4 flex justify-between">
            <h2>Dashboard</h2>
            <span>Admin</span>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- 🔥 Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const ctx = document.getElementById('chart');

    if (ctx) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Raptor', 'Nitro', 'Urban', 'Aero'],
                datasets: [{
                    data: [14, 16, 12, 8]
                }]
            }
        });
    }
    </script>

</body>
</html>