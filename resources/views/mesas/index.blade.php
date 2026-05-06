@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Mesas</h1>

    <a href="{{ route('mesas.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        + Nueva mesa
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($mesas as $mesa)

<div class="bg-white rounded-xl shadow-lg p-5 border-l-4 
    {{ $mesa->estado == 'libre' ? 'border-green-500' : 'border-red-500' }}">

    <h2 class="text-xl font-bold mb-2">Mesa {{ $mesa->numero }}</h2>

    <p class="text-gray-600">Zona: {{ $mesa->zona->nombre }}</p>
    <p class="text-gray-600">Capacidad: {{ $mesa->capacidad }}</p>

    <span class="inline-block mt-2 px-3 py-1 text-sm rounded
        {{ $mesa->estado == 'libre' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
        {{ ucfirst($mesa->estado) }}
    </span>

    <div class="mt-4 flex justify-between">

        <a href="{{ route('mesas.edit', $mesa->id) }}"
           class="text-blue-600 hover:underline">
            Editar
        </a>

        <form action="{{ route('mesas.destroy', $mesa->id) }}" method="POST">
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