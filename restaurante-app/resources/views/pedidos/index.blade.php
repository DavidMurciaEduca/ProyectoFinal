@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6">

    <!-- BOTONES VISTA -->
    <div class="flex justify-center gap-4 mb-4">

        <button id="btnCards"
                onclick="setView('cards')"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">

            🃏 Tarjetas

        </button>

        <button id="btnTable"
                onclick="setView('table')"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">

            📋 Tabla

        </button>

    </div>

    <!-- TITULO + BOTON -->
    <div class="flex justify-between items-center">

        <h1 class="text-3xl font-bold">
            Pedidos
        </h1>

        <a href="{{ route('pedidos.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">

            + Nuevo Pedido

        </a>

    </div>

</div>

<!-- ===================== -->
<!-- FILTROS -->
<!-- ===================== -->
<form method="GET" action="{{ route('pedidos.index') }}"
      class="bg-white p-4 rounded-xl shadow mb-6">

    <div class="flex flex-wrap gap-4 items-end">

        <!-- CAMARERO -->
        <div>
            <label class="text-sm font-semibold">Camarero</label>
            <select name="camarero_id" class="w-full border rounded-lg p-2">
                <option value="">Todos</option>
                @foreach($camareros as $camarero)
                    <option value="{{ $camarero->id }}"
                        {{ request('camarero_id') == $camarero->id ? 'selected' : '' }}>
                        {{ $camarero->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- MESA 
        <div>
            <label class="text-sm font-semibold">Mesa</label>
            <select name="mesa_id" class="w-full border rounded-lg p-2">
                <option value="">Todas</option>
                @foreach($mesas as $mesa)
                    <option value="{{ $mesa->id }}"
                        {{ request('mesa_id') == $mesa->id ? 'selected' : '' }}>
                        Mesa {{ $mesa->numero }}
                    </option>
                @endforeach
            </select>
        </div>-->

        <!-- ZONA -->
        <div>
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
        <div>
            <label class="text-sm font-semibold">Estado</label>

            <select name="estado" class="w-full border rounded-lg p-2">

                <option value="">Todos</option>

                <option value="pendiente"
                    {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="en_preparacion"
                    {{ request('estado') == 'en_preparacion' ? 'selected' : '' }}>
                    En preparación
                </option>

                <option value="listo"
                    {{ request('estado') == 'listo' ? 'selected' : '' }}>
                    Listo
                </option>

                <option value="finalizado"
                    {{ request('estado') == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>

            </select>
        </div>
        <!-- FECHA -->
        <div>
            <label class="text-sm font-semibold">Fecha</label>
            <input type="date"
                   name="fecha"
                   value="{{ request('fecha') }}"
                   class="w-full border rounded-lg p-2">
        </div>
        <div class="mt-4 flex gap-3">

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Filtrar
        </button>

        <a href="{{ route('pedidos.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded-lg">
            Reset
        </a>

    </div>

    </div>

    

</form>

<!-- ===================== -->
<!-- VISTA TARJETAS -->
<!-- ===================== -->
<div id="cardsView" class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($pedidos as $pedido)

<div class="bg-white rounded-2xl shadow-lg p-6">

    <div class="flex justify-between items-center">

        <h2 class="text-2xl font-bold">
            Mesa {{ $pedido->mesa->numero }}
        </h2>

        @if($pedido->estado == 'pendiente')
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Pendiente</span>

        @elseif($pedido->estado == 'en_preparacion')
            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">En preparación</span>
        @elseif($pedido->estado == 'listo')
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Listo</span>
        @elseif($pedido->estado == 'finalizado')
            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">Finalizado</span>
        @elseif($pedido->estado == 'servido')
            <span class="bg-gray-200 text-orange-700 px-3 py-1 rounded-full text-sm">Servido</span>
        @endif

    </div>

    <p class="mt-3 text-gray-600">
        Zona: <span class="font-semibold">{{ $pedido->mesa->zona->nombre }}</span>
    </p>

    <p class="mt-2 text-gray-600">
        Camarero: <span class="font-semibold">{{ $pedido->camarero->nombre }}</span>
    </p>

    <div class="mt-5 text-green-600 text-3xl font-bold">
        {{ $pedido->importe_total }} €
    </div>

    <div class="mt-5">
        <h3 class="font-semibold mb-2">Productos:</h3>

        <ul class="space-y-1">
            @foreach($pedido->items as $item)
                <li>{{ $item->cantidad }}x {{ $item->producto->nombre }}</li>
            @endforeach
        </ul>
    </div>

    <div class="flex gap-3 mt-5">

        <a href="{{ route('pedidos.edit', $pedido->id) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
            Editar
        </a>

        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="bg-red-600 text-white px-4 py-2 rounded-lg">
                Eliminar
            </button>
        </form>

    </div>

</div>

@endforeach

</div>

<!-- ===================== -->
<!-- VISTA TABLA -->
<!-- ===================== -->
<div id="tableView" class="hidden overflow-x-auto bg-white rounded-2xl shadow-lg">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>
            <th class="p-4 text-left">Zona</th>
            <th class="p-4 text-left">Mesa</th>
            <th class="p-4 text-left">Camarero</th>
            <th class="p-4 text-left">Estado</th>
            <th class="p-4 text-left">Total</th>
            <th class="p-4 text-left">Acciones</th>
        </tr>

    </thead>

    <tbody>

        @foreach($pedidos as $pedido)

        <tr class="border-b">

            <td class="p-4">{{ $pedido->mesa->zona->nombre }}</td>
            <td class="p-4">Mesa {{ $pedido->mesa->numero }}</td>
            <td class="p-4">{{ $pedido->camarero->nombre }}</td>

            <td class="p-4">

                @if($pedido->estado == 'pendiente')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">Pendiente</span>

                @elseif($pedido->estado == 'en_preparacion')
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">En preparación</span>

                @elseif($pedido->estado == 'listo')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">Listo</span>

                @elseif($pedido->estado == 'finalizado')
                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">Finalizado</span>
                @elseif($pedido->estado == 'servido')
                    <span class="bg-orange-200 text-gray-700 px-3 py-1 rounded-full text-sm">Servido</span>
                @endif

            </td>

            <td class="p-4 font-bold text-green-600">
                {{ $pedido->importe_total }} €
            </td>

            <td class="p-4 flex gap-2">

                <a href="{{ route('pedidos.edit', $pedido->id) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded-lg">
                    Editar
                </a>

                <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
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

<!-- ===================== -->
<!-- SCRIPT -->
<!-- ===================== -->
<script>

const cardsView = document.getElementById('cardsView');
const tableView = document.getElementById('tableView');

function setView(view)
{
    if(view === 'cards'){
        cardsView.classList.remove('hidden');
        tableView.classList.add('hidden');

        document.getElementById('btnCards').classList.add('bg-blue-600');
        document.getElementById('btnCards').classList.remove('bg-gray-600');

        document.getElementById('btnTable').classList.add('bg-gray-600');
        document.getElementById('btnTable').classList.remove('bg-blue-600');
    }

    if(view === 'table'){
        tableView.classList.remove('hidden');
        cardsView.classList.add('hidden');

        document.getElementById('btnTable').classList.add('bg-blue-600');
        document.getElementById('btnTable').classList.remove('bg-gray-600');

        document.getElementById('btnCards').classList.add('bg-gray-600');
        document.getElementById('btnCards').classList.remove('bg-blue-600');
    }

    localStorage.setItem('pedidoView', view);
}

document.addEventListener('DOMContentLoaded', function () {
    const savedView = localStorage.getItem('pedidoView') || 'cards';
    setView(savedView);
});

</script>

@endsection