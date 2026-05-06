@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Usuarios</h1>

    <a href="/usuarios/create" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Nuevo usuario
    </a>
</div>

<div class="bg-white shadow rounded overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="p-3">Nombre</th>
                <th class="p-3">Email</th>
                <th class="p-3">Tipo</th>
                <th class="p-3">Estado</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuarios as $usuario)
            <tr class="border-b">
                <td class="p-3">{{ $usuario->nombre }}</td>
                <td class="p-3">{{ $usuario->email }}</td>

                <td class="p-3">
                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">
                        {{ $usuario->tipo_usuario }}
                    </span>
                </td>

                <td class="p-3">
                    @if($usuario->activo)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Activo</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">Inactivo</span>
                    @endif
                </td>

                <td class="p-3 space-x-2">

                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-blue-600">
                        Editar
                    </a>

                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Eliminar</button>
                    </form>

                </td>
            </tr>
            @endforeach
            </tbody>

    </table>

</div>

@endsection