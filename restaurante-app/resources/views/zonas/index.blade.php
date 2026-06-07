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
            Zonas
        </h1>

        <a href="{{ route('zonas.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">

            + Nueva Zona

        </a>

    </div>

</div>

<!-- VISTA TARJETAS -->

<div id="cardsView"
     class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($zonas as $zona)

<div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition duration-300">

    <!-- Nombre zona -->

    <div class="flex justify-between items-center">

        <h2 class="text-2xl font-bold">

            {{ $zona->nombre }}

        </h2>

        <!-- Badge -->

        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

            Zona

        </span>

    </div>

    <!-- Número mesas -->

    <p class="mt-4 text-gray-600">

        Número de mesas:

        <span class="font-semibold">

            {{ $zona->mesas->count() }}

        </span>

    </p>

    <!-- Lista mesas -->

    <div class="mt-5">

        <h3 class="font-semibold mb-2">
            Mesas:
        </h3>

        <div class="flex flex-wrap gap-2">

            @foreach($zona->mesas as $mesa)

                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                    Mesa {{ $mesa->numero }}

                </span>

            @endforeach

        </div>

    </div>

    <!-- Botones -->

    <div class="flex gap-3 mt-6">

        <!-- Editar -->

        <a href="{{ route('zonas.edit', $zona->id) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">

            Editar

        </a>

        <!-- Eliminar -->

        <form action="{{ route('zonas.destroy', $zona->id) }}"
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
                    Zona
                </th>

                <th class="p-4 text-left">
                    Nº Mesas
                </th>

                <th class="p-4 text-left">
                    Mesas
                </th>

                <th class="p-4 text-left">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($zonas as $zona)

            <tr class="border-b hover:bg-gray-50 transition">

                <!-- Zona -->

                <td class="p-4 font-semibold">

                    {{ $zona->nombre }}

                </td>

                <!-- Número mesas -->

                <td class="p-4">

                    {{ $zona->mesas->count() }}

                </td>

                <!-- Mesas -->

                <td class="p-4">

                    @foreach($zona->mesas as $mesa)

                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm mr-1">

                            {{ $mesa->numero }}

                        </span>

                    @endforeach

                </td>

                <!-- Acciones -->

                <td class="p-4 flex gap-2 mt-4">

                    <!-- Editar -->

                    <a href="{{ route('zonas.edit', $zona->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">

                        Editar

                    </a>

                    <!-- Eliminar -->

                    <form action="{{ route('zonas.destroy', $zona->id) }}"
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

</script>

@endsection