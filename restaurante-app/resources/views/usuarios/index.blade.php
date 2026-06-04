@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-2xl font-bold">
        Usuarios
    </h1>

    <a href="/usuarios/create"
       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">

        + Nuevo usuario

    </a>

</div>

<div class="overflow-x-auto bg-white rounded-2xl shadow-lg">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-4 text-left">
                    Nombre
                </th>

                <th class="p-4 text-left">
                    Email
                </th>

                <th class="p-4 text-left">
                    Tipo
                </th>

                <th class="p-4 text-left">
                    Estado
                </th>
                <th class="p-4 text-left">
                    Zona
                </th>

                <th class="p-4 text-left">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($usuarios as $usuario)

            <tr class="border-b">

                <!-- Nombre -->
                <td class="p-4 font-semibold">

                    {{ $usuario->nombre }}

                </td>

                <!-- Email -->
                <td class="p-4">

                    {{ $usuario->email }}

                </td>

                <!-- Tipo -->
                <td class="p-4">

                    @if($usuario->tipo_usuario == 'gerente')

                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full">

                            Gerente

                        </span>

                    @elseif($usuario->tipo_usuario == 'camarero')

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

                            Camarero

                        </span>

                    @elseif($usuario->tipo_usuario == 'cocina')

                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full">

                            Cocina

                        </span>
                    @elseif($usuario->tipo_usuario == 'admin')

                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full">

                            Admin

                        </span>

                    @endif


                </td>
                <td class="p-4">
                     @if($usuario->tipo_usuario == 'camarero')
                        {{ $usuario->zona?->nombre }}
                    @endif
                </td>
                <!-- Estado -->
                <td class="p-4">

                    @if($usuario->activo)

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
                <td class="p-4 flex gap-2">

                    @php

                        $userLogueado = Auth::user();

                        $esAdminObjetivo = $usuario->tipo_usuario == 'admin';

                        $esGerente = $userLogueado->tipo_usuario == 'gerente';
                        $esGerenteObjetivo = $usuario->tipo_usuario == 'gerente'

                    @endphp

                    {{-- GERENTE NO PUEDE TOCAR ADMIN --}}
                    @if(!($esGerente && ($esAdminObjetivo || $esGerenteObjetivo)))

                        <!-- EDITAR -->
                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">

                            Editar

                        </a>

                        <!-- ELIMINAR -->
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition">

                                Eliminar

                            </button>

                        </form>


                    @endif

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection