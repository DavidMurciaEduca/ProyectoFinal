@extends('layouts.app')

@section('content')

<!-- HEADER -->

<div class="mb-6">

    <!-- Fila 1: botones centrados -->

    <div class="flex justify-center gap-4 mb-4">

        <button id="btnCards"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">

            🃏 Tarjetas

        </button>

        <button id="btnTable"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">

            📋 Tabla

        </button>

    </div>

    <!-- Fila 2: título + botón -->

    <div class="flex justify-between items-center">

        <h1 class="text-3xl font-bold">
            Mesas
        </h1>

        <a href="{{ route('mesas.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">

            + Nueva Mesa

        </a>

    </div>

</div>
<!-- FILTROS -->
<form method="GET" action="{{ route('mesas.index') }}"
      class="bg-white p-4 rounded-xl shadow mb-6">

    <div class="flex flex-wrap gap-4 items-end">

        <!-- ZONA -->
        <div class="w-48">
            <label class="text-sm font-semibold">Zona</label>
            <select name="zona_id" class="w-full border rounded-lg p-2">
                <option value="">Todas</option>

                @foreach($zonas as $zona)
                    <option value="{{ $zona->id }}"
                        {{ request('zona_id') == $zona->id ? 'selected' : '' }}>
                        {{ $zona->nombre }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- ESTADO -->
        <div class="w-48">
            <label class="text-sm font-semibold">Estado</label>
            <select name="estado" class="w-full border rounded-lg p-2">

                <option value="">Todos</option>

                <option value="libre"
                    {{ request('estado') == 'libre' ? 'selected' : '' }}>
                    Libre
                </option>

                <option value="ocupada"
                    {{ request('estado') == 'ocupada' ? 'selected' : '' }}>
                    Ocupada
                </option>

            </select>
        </div>

        <!-- BOTONES -->
        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Filtrar
            </button>

            <a href="{{ route('mesas.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                Reset
            </a>
        </div>

    </div>

</form>
<!-- VISTA TARJETAS -->

<div id="cardsView"
     class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($mesas as $mesa)

<div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition duration-300">

    <!-- Mesa + Estado -->

    <div class="flex justify-between items-center">

        <h2 class="text-2xl font-bold">

            Mesa {{ $mesa->numero }}

        </h2>

        <!-- Estado -->

        @if($mesa->estado == 'libre')

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                Libre

            </span>

        @else

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                Ocupada

            </span>

        @endif

    </div>

    <!-- Zona -->

    <p class="mt-4 text-gray-600">

        Zona:

        <span class="font-semibold">

            {{ $mesa->zona->nombre }}

        </span>

    </p>

    <!-- Capacidad -->

    <p class="mt-2 text-gray-600">

        Capacidad:

        <span class="font-semibold">

            {{ $mesa->capacidad }} personas

        </span>

    </p>

    <!-- Botones -->

    <div class="flex gap-3 mt-6">

        <!-- Editar -->

        <a href="{{ route('mesas.edit', $mesa->id) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">

            Editar

        </a>

        <!-- Eliminar -->

        <form action="{{ route('mesas.destroy', $mesa->id) }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">

                Eliminar

            </button>

        </form>

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
                    Mesa
                </th>

                <th class="p-4 text-left">
                    Zona
                </th>

                <th class="p-4 text-left">
                    Capacidad
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

            @foreach($mesas as $mesa)

            <tr class="border-b hover:bg-gray-50 transition">

                <!-- Mesa -->

                <td class="p-4 font-semibold">

                    Mesa {{ $mesa->numero }}

                </td>

                <!-- Zona -->

                <td class="p-4">

                    {{ $mesa->zona->nombre }}

                </td>

                <!-- Capacidad -->

                <td class="p-4">

                    {{ $mesa->capacidad }}

                </td>

                <!-- Estado -->

                <td class="p-4">

                    @if($mesa->estado == 'libre')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            Libre

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            Ocupada

                        </span>

                    @endif

                </td>

                <!-- Acciones -->

                <td class="p-4 flex gap-2 mt-4">

                    <!-- Editar -->

                    <a href="{{ route('mesas.edit', $mesa->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">

                        Editar

                    </a>

                    <!-- Eliminar -->

                    <form action="{{ route('mesas.destroy', $mesa->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700">

                            Eliminar

                        </button>

                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<!-- SCRIPT -->

<script>

    const btnCards = document.getElementById('btnCards');
    const btnTable = document.getElementById('btnTable');

    const cardsView = document.getElementById('cardsView');
    const tableView = document.getElementById('tableView');

    function setView(view)
    {
        if (view === 'cards') {

            cardsView.classList.remove('hidden');
            tableView.classList.add('hidden');

            btnCards.classList.add('bg-blue-600');
            btnCards.classList.remove('bg-gray-600');

            btnTable.classList.add('bg-gray-600');
            btnTable.classList.remove('bg-blue-600');
        }

        if (view === 'table') {

            tableView.classList.remove('hidden');
            cardsView.classList.add('hidden');

            btnTable.classList.add('bg-blue-600');
            btnTable.classList.remove('bg-gray-600');

            btnCards.classList.add('bg-gray-600');
            btnCards.classList.remove('bg-blue-600');
        }

        // guardar vista
        localStorage.setItem('mesaView', view);
    }

    // botones
    btnCards.addEventListener('click', () => setView('cards'));
    btnTable.addEventListener('click', () => setView('table'));

    // cargar vista guardada
    document.addEventListener('DOMContentLoaded', () => {

        const savedView = localStorage.getItem('mesaView') || 'cards';

        setView(savedView);
    });

</script>

@endsection