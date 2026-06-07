@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">
        Editar Categoría
    </h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label>Nombre</label>

            <input
                type="text"
                name="nombre"
                value="{{ $categoria->nombre }}"
                class="w-full border p-2 rounded"
            >

            @error('nombre')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>

    </form>

</div>

@endsection