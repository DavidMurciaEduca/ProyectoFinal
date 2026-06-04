@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">
        Nuevo Usuario
    </h1>

    <form action="{{ route('usuarios.store') }}" method="POST">

        @csrf

        <!-- Nombre -->
        <div class="mb-4">

            <label>Nombre</label>

            <input
                type="text"
                name="nombre"
                value="{{ old('nombre') }}"
                class="w-full border p-2 rounded"
            >

            @error('nombre')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <!-- Email -->
        <div class="mb-4">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border p-2 rounded"
            >

            @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <!-- Contraseña -->
        <div class="mb-4">

            <label>Contraseña</label>

            <input
                type="password"
                name="password"
                class="w-full border p-2 rounded"
            >

            @error('password')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <!-- Tipo Usuario -->
        <div class="mb-4">

            <label>Tipo de usuario</label>

            <select
                id='tipoUsuario'
                name="tipo_usuario"
                class="w-full border p-2 rounded"
            >

                <option value=null>
                    Seleccionar
                </option>

                <option value="camarero">
                    Camarero
                </option>

                <option value="cocina">
                    Cocina
                </option>

                <option value="gerente">
                    Gerente
                </option>
                <option value="admin">
                    Admin
                </option>

            </select>

        </div>
        <div id="zonaContainer" class="mb-4 hidden" >

            <label>Zona</label>

            <select name="zona_id"  class="w-full border p-2 rounded">

                <option value=null>
                    Sin zona
                </option>

                @foreach($zonas as $zona)
                    <option value="{{ $zona->id }}"
                        {{ old('zona_id') == $zona->id ? 'selected' : '' }}>

                        {{ $zona->nombre }}

                    </option>
                @endforeach

            </select>

        </div>
        <!-- Usuario activo -->
        <div class="mb-4 flex items-center">

            <input
                type="checkbox"
                name="activo"
                value="1"
                checked
                class="mr-2"
            >

            <label>
                Usuario activo
            </label>

        </div>

        <!-- Botón -->
        <button class="bg-green-600 text-white px-4 py-2 rounded">

            Guardar

        </button>

    </form>

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
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tipo = document.querySelector('select[name="tipo_usuario"]');
    const zona = document.getElementById('zonaContainer');
    if (!tipo || !zona) return;

    function toggleZona() {
        zona.style.display = (tipo.value === 'camarero') ? 'block' : 'none';
    }

    tipo.addEventListener('change', toggleZona);

    toggleZona();

});

const tipoUsuario = document.getElementById('tipoUsuario');
const zona = document.getElementById('zonaContainer');
console.log(tipoUsuario)
tipoUsuario.addEventListener('change', function () {

    if (this.value === 'camarero') {
        zona.classList.remove('hidden');
    } else {
        zona.classList.add('hidden');
    }

});
</script>
@endpush
@endsection
