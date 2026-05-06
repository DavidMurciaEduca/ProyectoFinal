@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">➕ Nuevo Usuario</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <!-- Nombre -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
                <input 
                    type="text" 
                    name="nombre"
                    value="{{ old('nombre') }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror"
                >
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                <input 
                    type="password" 
                    name="password"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo usuario -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Tipo de usuario</label>
                <select 
                    name="tipo_usuario"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Seleccionar</option>
                    <option value="camarero">Camarero</option>
                    <option value="cocina">Cocina</option>
                    <option value="gerente">Gerente</option>
                </select>
            </div>

            <!-- Activo -->
            <div class="mb-5 flex items-center">
                <input type="checkbox" name="activo" value="1" checked class="mr-2">
                <label>Usuario activo</label>
            </div>

            <!-- Botones -->
            <div class="flex justify-between">

                <a href="/usuarios" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>

                <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection