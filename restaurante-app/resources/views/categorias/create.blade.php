@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">
        Nueva Categoría
    </h1>

    <form action="{{ route('categorias.store') }}" method="POST">

        @csrf

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

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Guardar
        </button>

    </form>

</div>

@endsection