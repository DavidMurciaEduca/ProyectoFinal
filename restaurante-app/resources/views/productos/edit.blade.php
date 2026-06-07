@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">
        Editar Producto
    </h1>

    <form action="{{ route('productos.update', $producto->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-4">

            <label>
                Nombre
            </label>

            <input
                type="text"
                name="nombre"
                value="{{ $producto->nombre }}"
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
            >{{ $producto->descripcion }}</textarea>
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
                value="{{ $producto->precio }}"
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

                    <option value="{{ $categoria->id }}"
                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>

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

            @if($producto->imagen)

                <img src="{{ asset('storage/' . $producto->imagen) }}"
                     class="w-32 h-32 object-cover rounded mb-3">

            @endif

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
                {{ $producto->activo ? 'checked' : '' }}
                class="mr-2"
            >

            <label>
                Producto activo
            </label>

        </div>

        <!-- Botones -->
        <div class="flex gap-3">

            <a href="/productos"
               class="bg-gray-500 text-white px-4 py-2 rounded">

                Cancelar

            </a>

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">

                Actualizar

            </button>

        </div>

    </form>

</div>

@endsection