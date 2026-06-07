@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">
        Nuevo Producto
    </h1>

    <form action="{{ route('productos.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- Nombre -->
        <div class="mb-4">

            <label>
                Nombre
            </label>

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

        <!-- Descripción -->
        <div class="mb-4">

            <label>
                Descripción
            </label>

            <textarea
                name="descripcion"
                rows="4"
                class="w-full border p-2 rounded"
            >{{ old('descripcion') }}</textarea>

            @error('descripcion')

                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Precio -->
        <div class="mb-4">

            <label>
                Precio
            </label>

            <input
                type="number"
                step="0.01"
                name="precio"
                value="{{ old('precio') }}"
                class="w-full border p-2 rounded"
            >

            @error('precio')

                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- Categoría -->
        <div class="mb-4">

            <label>
                Categoría
            </label>

            <select
                name="categoria_id"
                class="w-full border p-2 rounded"
            >

                @foreach($categorias as $categoria)

                    <option value="{{ $categoria->id }}">

                        {{ $categoria->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- Imagen -->
        <div class="mb-4">

            <label>
                Imagen
            </label>

            <input
                type="file"
                name="imagen"
                class="w-full border p-2 rounded"
            >

        </div>

        <!-- Activo -->
        <div class="mb-4 flex items-center">

            <input
                type="checkbox"
                name="activo"
                value="1"
                checked
                class="mr-2"
            >

            <label>
                Producto activo
            </label>

        </div>

        <!-- Botón -->
        <button class="bg-green-600 text-white px-4 py-2 rounded">

            Guardar

        </button>

    </form>

</div>

@endsection