@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

<h1 class="text-2xl font-bold mb-4">Nueva Mesa</h1>

<form action="{{ route('mesas.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label>Número</label>
        <input type="number" name="numero" class="w-full border p-2 rounded">
        @error('numero')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Zona</label>
        <select name="zona" class="w-full border p-2 rounded">
            <option value=null>
                Selecciona una zona
            </option>
        @foreach($zonas as $zona)
            <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
        @endforeach

        </select>
        @error('zona')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label>Capacidad</label>
        <input type="number" name="capacidad" class="w-full border p-2 rounded">
        @error('capacidad')
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