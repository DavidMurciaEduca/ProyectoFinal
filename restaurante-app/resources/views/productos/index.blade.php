@extends('layouts.app')

@section('content')

<!-- HEADER -->

<div class="mb-6">

    <!-- Fila 1: botones centrados -->
    <div class="flex justify-center gap-4 mb-4">

        <button id="btnCards" onclick="setView('cards')"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">

            🃏 Tarjetas

        </button>

        <button id="btnTable" onclick="setView('table')"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">

            📋 Tabla

        </button>

    </div>

    <!-- Fila 2: título + botón -->
    <div class="flex justify-between items-center">

        <h1 class="text-3xl font-bold">
            Productos
        </h1>

        <a href="{{ route('productos.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">

            + Nuevo producto

        </a>

    </div>

</div>
<form method="GET" class="mb-6 bg-white p-4 rounded-xl shadow flex gap-4 flex-wrap">
    <input type="hidden" name="view" id="viewMode" value="{{ request('view', 'cards') }}">
    <!-- NOMBRE -->
    <input type="text"
           name="nombre"
           value="{{ request('nombre') }}"
           placeholder="Buscar producto..."
           class="border rounded-lg px-3 py-2">

    <!-- CATEGORÍA -->
    <select name="categoria_id"
            class="border rounded-lg px-3 py-2">

        <option value="">Todas las categorías</option>

        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}"
                {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
        @endforeach

    </select>

    <!-- ESTADO -->
    <select name="estado"
            class="border rounded-lg px-3 py-2">

        <option value="">Estado</option>

        <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>
            Activo
        </option>

        <option value="0" {{ request('estado') == '0' ? 'selected' : '' }}>
            Inactivo
        </option>

    </select>

    <!-- BOTÓN -->
    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        Filtrar
    </button>

    <a href="{{ route('productos.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded-lg">
        Reset
    </a>

</form>
<div id="cardsView" class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($productos as $producto)

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <div class="p-5">
        @if($producto->imagen)
            <img src="{{ asset('storage/' . $producto->imagen) }}"
                class="w-full h-48 object-cover rounded-2xl">
        @endif
        <div class="flex justify-between items-center mt-3">

            <h2 class="text-xl font-bold">
                {{ $producto->nombre }}
            </h2>

            <span class="px-3 py-1 text-sm rounded-full
                {{ $producto->activo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                {{ $producto->activo ? 'Activo' : 'Inactivo' }}

            </span>

        </div>

        <p class="text-gray-500 mt-3">
            {{ $producto->descripcion }}
        </p>

        <p class="mt-2 text-gray-700">
            Categoría:
            <span class="font-semibold">
                {{ $producto->categoria->nombre }}
            </span>
        </p>

        <div class="mt-5">

            <span class="text-2xl font-bold text-blue-600">
                {{ $producto->precio }} €
            </span>

        </div>

        <div class="mt-6 flex justify-between">

            <a href="{{ route('productos.edit', $producto->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded-lg">

                        Editar

            </a>

            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <button class="bg-red-600 text-white px-3 py-1 rounded-lg">

                            Eliminar

                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

</div>
<!-- TABLA -->

<div id="tableView"
     class="hidden overflow-x-auto bg-white rounded-2xl shadow-lg">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-4 text-left">
                    Imagen
                </th>

                <th class="p-4 text-left">
                    Nombre
                </th>

                <th class="p-4 text-left">
                    Precio
                </th>

                <th class="p-4 text-left">
                    Categoría
                </th>

                <th class="p-4 text-left">
                    Estado
                </th>

                <th class="p-4 text-left">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($productos as $producto)

            <tr class="border-b">

                <!-- Imagen -->
                <td class="p-4">

                    @if($producto->imagen)

                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                             class="w-16 h-16 object-cover rounded-lg">

                    @endif

                </td>

                <!-- Nombre -->
                <td class="p-4 font-semibold">

                    {{ $producto->nombre }}

                </td>

                <!-- Precio -->
                <td class="p-4">

                    {{ $producto->precio }} €

                </td>

                <!-- Categoría -->
                <td class="p-4">

                    {{ $producto->categoria->nombre }}

                </td>

                <!-- Estado -->
                <td class="p-4">

                    @if($producto->activo)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            Activo

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            Inactivo

                        </span>

                    @endif

                </td>

                <!-- Acciones -->
                <td class="p-4 flex mt-4 gap-2">

                    <!-- Editar -->
                    <a href="{{ route('productos.edit', $producto->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded-lg">

                        Editar

                    </a>

                    <!-- Eliminar -->
                    <form action="{{ route('productos.destroy', $producto->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="bg-red-600 text-white px-3 py-1 rounded-lg">

                            Eliminar

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>
<script>

    const btnCards = document.getElementById('btnCards');

    const btnTable = document.getElementById('btnTable');

    const cardsView = document.getElementById('cardsView');

    const tableView = document.getElementById('tableView');

    // Mostrar tarjetas
    btnCards.addEventListener('click', () => {

        cardsView.classList.remove('hidden');

        tableView.classList.add('hidden');

        btnCards.classList.remove('bg-gray-600');
        btnCards.classList.add('bg-blue-600');

        btnTable.classList.remove('bg-blue-600');
        btnTable.classList.add('bg-gray-600');

    });

    // Mostrar tabla
    btnTable.addEventListener('click', () => {

        tableView.classList.remove('hidden');

        cardsView.classList.add('hidden');

        btnTable.classList.remove('bg-gray-600');
        btnTable.classList.add('bg-blue-600');

        btnCards.classList.remove('bg-blue-600');
        btnCards.classList.add('bg-gray-600');

    });
    function setView(view)
    {
        document.getElementById('viewMode').value = view;

        if(view === 'cards') {
            cardsView.classList.remove('hidden');
            tableView.classList.add('hidden');
        } else {
            tableView.classList.remove('hidden');
            cardsView.classList.add('hidden');
        }

        // actualizar estilos botones (opcional)
    }
    const initialView = "{{ request('view', 'cards') }}";

    if(initialView === 'table') {
        tableView.classList.remove('hidden');
        cardsView.classList.add('hidden');
    }
</script>
@endsection