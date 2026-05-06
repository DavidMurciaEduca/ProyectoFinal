@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Zonas</h1>

    <a href="{{ route('zonas.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        + Nueva zona
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($zonas as $zona)

    <div class="bg-white p-5 rounded-xl shadow-lg">

        <h2 class="text-xl font-bold mb-2">{{ $zona->nombre }}</h2>

        <div class="flex justify-between mt-4">

            <a href="{{ route('zonas.edit', $zona->id) }}"
               class="text-blue-600">Editar</a>

            <form action="{{ route('zonas.destroy', $zona->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-600">Eliminar</button>
            </form>

        </div>

    </div>

@endforeach

</div>

@endsection