@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">✏️ Editar Usuario</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
                <input 
                    type="text" 
                    name="nombre"
                    value="{{ old('nombre', $usuario->nombre) }}"
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
                    value="{{ old('email', $usuario->email) }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">
                    Nueva contraseña (opcional)
                </label>
                <input 
                    type="password" 
                    name="password"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Tipo usuario -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Tipo de usuario</label>
                <select id='tipoUsuario' name="tipo_usuario" class="w-full border rounded-lg px-4 py-2">

                    <option value="camarero" {{ $usuario->tipo_usuario == 'camarero' ? 'selected' : '' }}>
                        Camarero
                    </option>

                    <option value="cocina" {{ $usuario->tipo_usuario == 'cocina' ? 'selected' : '' }}>
                        Cocina
                    </option>

                    <option value="gerente" {{ $usuario->tipo_usuario == 'gerente' ? 'selected' : '' }}>
                        Gerente
                    </option>
                    <option value="admin" {{ $usuario->tipo_usuario == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>
            </div>
            <div id="zonaContainer" class="mb-4 {{ $usuario->tipo_usuario !== 'camarero' ? 'hidden' : '' }}" >

            <label>Zona</label>

            <select name="zona_id"  class="w-full border p-2 rounded">
                <option value=null>
                    Sin zona
                </option>
                @foreach($zonas as $zona)
                    <option value={{ $zona->id }}
                        {{ old('zona_id', $usuario->zona_id) == $zona->id ? 'selected' : '' }}>

                        {{ $zona->nombre }}

                    </option>
                @endforeach

            </select>

        </div>
            <!-- Activo -->
            <div class="mb-5 flex items-center">
                <input 
                    type="checkbox" 
                    name="activo" 
                    value="1"
                    {{ $usuario->activo ? 'checked' : '' }}
                    class="mr-2"
                >
                <label>Usuario activo</label>
            </div>

            <!-- Botones -->
            <div class="flex justify-between">

                <a href="/usuarios" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>

                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Actualizar
                </button>

            </div>

        </form>

    </div>

</div>
<script>
const tipoUsuario = document.getElementById('tipoUsuario');
const zona = document.getElementById('zonaContainer');
tipoUsuario.addEventListener('change', function () {

    if (this.value === 'camarero') {
        zona.classList.remove('hidden');
    } else {
        zona.classList.add('hidden');
    }

});
</script>
@endsection