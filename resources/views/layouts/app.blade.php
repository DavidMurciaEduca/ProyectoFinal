<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restaurante App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-gray-900 text-white shadow">

    <div class="container mx-auto flex justify-between items-center px-6 py-4">

        <!-- LOGO -->
        <div class="text-xl font-bold">
            🍽️ Restaurante
        </div>

        <!-- MENÚ -->
        <div class="space-x-4">

            <a href="/dashboard" class="hover:text-yellow-400">Dashboard</a>
            <a href="/usuarios" class="hover:text-yellow-400">Usuarios</a>
            <a href="/productos" class="hover:text-yellow-400">Productos</a>
            <a href="/pedidos" class="hover:text-yellow-400">Pedidos</a>
            <a href="/zonas" class="hover:text-yellow-400">Zonas</a>
            <a href="/mesas" class="hover:text-yellow-400">Mesas</a>
        </div>

        <!-- USER -->
        <div>
            👤 Admin
        </div>

    </div>

</nav>

<!-- CONTENIDO -->
<main class="container mx-auto p-6">

    @yield('content')

</main>

</body>
</html>