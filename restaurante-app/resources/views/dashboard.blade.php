@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Ingresos
        </h1>

        <!-- FILTROS -->
        <form method="GET" action="{{ route('dashboard') }}">

            <select name="filtro"
                    onchange="this.form.submit()"
                    class="border rounded-lg px-4 py-2">

                <option value="hoy"
                    {{ $filtro == 'hoy' ? 'selected' : '' }}>
                    Hoy
                </option>

                <option value="semana"
                    {{ $filtro == 'semana' ? 'selected' : '' }}>
                    Semana
                </option>

                <option value="mes"
                    {{ $filtro == 'mes' ? 'selected' : '' }}>
                    Mes
                </option>

            </select>

        </form>

    </div>

    <!-- TABLA -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">
                        Camarero
                    </th>

                    <th class="p-4 text-left">
                        Ingresos
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($ingresosPorCamarero as $item)

                <tr class="border-b">

                    <td class="p-4 font-semibold">

                        {{ $item->camarero->nombre }}

                    </td>

                    <td class="p-4 text-green-600 font-bold">

                        {{ number_format($item->total, 2) }} €

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <!-- TOTAL -->
    <div class="mt-6 bg-green-600 text-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-2xl font-bold">

            Total ingresos:
            {{ number_format($totalIngresos, 2) }} €

        </h2>

    </div>
    <div class="mt-6">
        <h1 class="text-3xl font-bold">
            Ventas Plato Estrella / Bebida Estrella
        </h1>
    </div>
    
    <div class="mt-10 bg-white rounded-2xl shadow-lg overflow-hidden">

   

        



    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-4 text-left">
                    Camarero
                </th>

                <th class="p-4 text-left">
                    Unidades vendidas
                </th>
                <th class="p-4 text-left">
                    Bonus
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($ventasEstrella as $item)

            <tr class="border-b">

                <td class="p-4 font-semibold">

                    {{ $item->nombre }}

                </td>

                <td class="p-4 text-green-600 font-bold">

                    {{ $item->total_vendidos }}

                </td>
                <td class="p-4 text-blue-600 font-bold">
                    {{ number_format($item->bonus, 2) }} €
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="2" class="p-6 text-center text-gray-500">

                    No hay ventas registradas

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>
    
</div>
 <!-- TOTAL -->
    <div class="mt-6 bg-green-600 text-white p-6 rounded-2xl shadow-lg">

        <h2 class="text-2xl font-bold">

            Numero total de las ventas:
            {{ $totalPlatosEstrella }}

        </h2>

    </div>
    <div class="mt-10 flex justify-end">

    <form method="GET" action="{{ route('dashboard') }}">

        <input type="hidden" name="filtro" value="{{ $filtro }}">

        <select
            name="mes"
            onchange="this.form.submit()"
            class="border rounded-lg px-4 py-2">

            @foreach(range(1,12) as $mes)

                <option
                    value="{{ $mes }}"
                    {{ $mesSeleccionado == $mes ? 'selected' : '' }}>

                    {{ \Carbon\Carbon::create()->month($mes)->locale('es')->monthName }}

                </option>

            @endforeach

        </select>

    </form>

</div>

<div class="mt-10">

    <h2 class="text-3xl font-bold mb-4">
        Ranking Plato Estrella / Bebida Estrella
    </h2>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">
                        Producto
                    </th>

                    <th class="p-4 text-left">
                        Unidades vendidas
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($rankingProductos as $producto)

                <tr class="border-b">

                    <td class="p-4 font-semibold">
                        {{ $producto->nombre }}
                    </td>

                    <td class="p-4 text-green-600 font-bold">
                        {{ $producto->total_vendidos }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="2" class="p-4 text-center text-gray-500">
                        No hay ventas para este mes
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
</div>


@endsection