@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Productos</h1>

    <a href="/productos/create" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Nuevo producto
    </a>
</div>

<div class="bg-white shadow rounded overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="p-3">Nombre</th>
                <th class="p-3">Categoría</th>
                <th class="p-3">Precio</th>
                <th class="p-3">Estado</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <!-- Ejemplo -->
            <tr class="border-b">
                <td class="p-3">Hamburguesa</td>
                <td class="p-3">Comida</td>
                <td class="p-3">10.50 €</td>

                <td class="p-3">
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">
                        Activo
                    </span>
                </td>

                <td class="p-3 space-x-2">
                    <a href="/productos/1/edit" class="text-blue-600">Editar</a>
                    <a href="#" class="text-red-600">Eliminar</a>
                </td>
            </tr>

        </tbody>

    </table>

</div>

@endsection