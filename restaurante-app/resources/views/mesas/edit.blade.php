@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

<h1 class="text-2xl font-bold mb-4">Editar Mesa</h1>

<form action="{{ route('mesas.update', $mesa->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Número</label>
        <input type="number" name="numero" value="{{ $mesa->numero }}" class="w-full border p-2 rounded">
        @error('numero')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Zona</label>
        <select name="zona_id" class="w-full border p-2 rounded">

        @foreach($zonas as $zona)
            <option value="{{ $zona->id }}" 
                {{ $mesa->zona_id == $zona->id ? 'selected' : '' }}>
                {{ $zona->nombre }}
            </option>
        @endforeach

        </select>
        @error('zona_id')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Capacidad</label>
        <input type="number" name="capacidad" value="{{ $mesa->capacidad }}" class="w-full border p-2 rounded">
        @error('capacidad')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Estado</label>
        <select name="estado" class="w-full border p-2 rounded">
            <option value="libre" {{ $mesa->estado == 'libre' ? 'selected' : '' }}>Libre</option>
            <option value="ocupada" {{ $mesa->estado == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
    Actualizar
    </button>

</form>

</div>

@endsection