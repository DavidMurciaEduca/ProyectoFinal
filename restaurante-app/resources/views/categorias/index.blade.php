@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Categorías
    </h1>

    <a href="{{ route('categorias.create') }}"
       class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
        + Nueva categoría
    </a>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($categorias as $categoria)

<div class="bg-white rounded-2xl shadow-lg p-6">

    <h2 class="text-xl font-bold mb-4">
        {{ $categoria->nombre }}
    </h2>

    <div class="flex justify-between">

        <a href="{{ route('categorias.edit', $categoria->id) }}"
           class="text-blue-600 hover:underline">
            Editar
        </a>

        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">

            @csrf
            @method('DELETE')

            <button class="text-red-600 hover:underline">
                Eliminar
            </button>

        </form>

    </div>

</div>

@endforeach

</div>

@endsection