<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restaurante App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen text-sm text-gray-800">

    <nav class="bg-gray-900 text-white shadow" x-data="{ mobileMenuOpen: false }">

        <div class="container mx-auto flex justify-between items-center px-6 py-3">

            <div class="text-xl font-bold tracking-wide">
                🍽️ Restaurante
            </div>

            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-400 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
                    </svg>
                </button>
            </div>

            <div class="hidden md:flex space-x-4 text-sm items-center">
                <a href="/dashboard" class="hover:text-yellow-400 transition">Dashboard</a>
                <a href="/usuarios" class="hover:text-yellow-400 transition">Usuarios</a>
                <a href="/categorias" class="hover:text-yellow-400 transition">Categorias</a>
                <a href="/productos" class="hover:text-yellow-400 transition">Productos</a>
                <a href="/pedidos" class="hover:text-yellow-400 transition">Pedidos</a>
                <a href="/zonas" class="hover:text-yellow-400 transition">Zonas</a>
                <a href="/mesas" class="hover:text-yellow-400 transition">Mesas</a>
            </div>

            <div class="relative hidden md:block" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 text-sm font-semibold hover:text-yellow-400 transition">
                    👤 {{ Auth::user()->nombre ?? 'Usuario' }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white text-black rounded-lg shadow-lg overflow-hidden z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <div x-show="mobileMenuOpen" class="md:hidden bg-gray-800 border-t border-gray-700" style="display: none;">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="/dashboard" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Dashboard</a>
                <a href="/usuarios" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Usuarios</a>
                <a href="/categorias" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Categorias</a>
                <a href="/productos" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Productos</a>
                <a href="/pedidos" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Pedidos</a>
                <a href="/zonas" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Zonas</a>
                <a href="/mesas" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-gray-700 hover:text-yellow-400 transition">Mesas</a>
                
                <hr class="border-gray-700 my-2">
                
                <div class="px-3 py-2 text-gray-400 font-semibold flex justify-between items-center">
                    <span>👤 {{ Auth::user()->nombre ?? 'Usuario' }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm bg-red-600/20 text-red-400 px-3 py-1 rounded hover:bg-red-600/40 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </nav>

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>

</html>