@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-xl p-8">

        <h1 class="text-3xl font-bold mb-8">
            Editar Pedido
        </h1>

        <form action="{{ route('pedidos.update', $pedido->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <!-- MESA -->
            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Mesa
                </label>

                <select name="mesa_id"
                        class="w-full border rounded-lg px-4 py-3"
                        {{ $pedido->estado === 'finalizado' ? 'disabled' : '' }}>

                    @foreach($zonas as $zona)

                        <optgroup label="{{ $zona->nombre }}">

                            @foreach($zona->mesas as $mesa)

                                <option value="{{ $mesa->id }}"
                                    {{ $pedido->mesa_id == $mesa->id ? 'selected' : '' }}>

                                    Mesa {{ $mesa->numero }}

                                </option>

                            @endforeach

                        </optgroup>

                    @endforeach

                </select>

            </div>

            <!-- ESTADO -->
            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Estado del pedido
                </label>

                <select name="estado"
                        class="w-full border rounded-lg px-4 py-3">

                    <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>

                    <option value="en_preparacion" {{ $pedido->estado == 'en_preparacion' ? 'selected' : '' }}>
                        En preparación
                    </option>

                    <option value="listo" {{ $pedido->estado == 'listo' ? 'selected' : '' }}>
                        Listo
                    </option>
                    <option value="servido" {{ $pedido->estado == 'servido' ? 'selected' : '' }}>
                        Servido
                    </option>
                    <option value="finalizado" {{ $pedido->estado == 'finalizado' ? 'selected' : '' }}>
                        Finalizado
                    </option>
                </select>

            </div>

            <!-- PRODUCTOS -->
            <h2 class="text-2xl font-bold mb-4">
                Productos
            </h2>

            <div id="productosContainer">

                @foreach($pedido->items as $index => $item)

                <div class="producto-item grid grid-cols-12 gap-3 mb-4 bg-gray-50 p-4 rounded-lg items-center">

                    <!-- Producto -->
                    <div class="col-span-4">

                        <select name="productos[{{ $index }}][producto_id]"
                                class="w-full border rounded-lg px-3 py-2"
                                {{ $pedido->estado === 'finalizado' ? 'disabled' : '' }}>

                            @foreach($productos as $producto)

                                <option value="{{ $producto->id }}"
                                    {{ $item->producto_id == $producto->id ? 'selected' : '' }}>

                                    {{ $producto->nombre }} - {{ $producto->precio }}€

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Cantidad -->
                    <div class="col-span-2">

                        <input type="number"
                               name="productos[{{ $index }}][cantidad]"
                               value="{{ $item->cantidad }}"
                               class="w-full border rounded-lg px-3 py-2"
                               {{ $pedido->estado === 'finalizado' ? 'disabled' : '' }}>

                    </div>

                    <!-- Notas -->
                    <div class="col-span-5">

                        <input type="text"
                               name="productos[{{ $index }}][notas]"
                               value="{{ $item->notas }}"
                               class="w-full border rounded-lg px-3 py-2"
                               {{ $pedido->estado === 'finalizado' ? 'disabled' : '' }}>

                    </div>

                    <!-- BORRAR -->
                    @if($pedido->estado != 'finalizado')
                        <div class="col-span-1 flex justify-center">

                            <button type="button"
                                    class="delete-producto bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition">

                                Eliminar

                            </button>

                        </div>
                    @endif

                </div>

                @endforeach

            </div>
            @if ($errors->any())
                    <p class="text-red-500 text-sm mt-1">
                        Al menos tiene que eligir un producto
                    </p>
                @endif
            <!-- BOTÓN AÑADIR -->
            @if($pedido->estado != 'finalizado')
                <div>
                    <button type="button"
                        id="addProducto"
                        class="mb-8 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">

                        + Añadir producto

                    </button>
                </div>
           @endif

            <!-- GUARDAR -->
            <button class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600">

                Actualizar Pedido

            </button>

        </form>

    </div>

</div>

<!-- JS -->
<script>

    let contador = {{ count($pedido->items) }};

    const productos = @json($productos);

    const container = document.getElementById('productosContainer');

    // ==========================
    // AÑADIR PRODUCTO
    // ==========================
    document.getElementById('addProducto').addEventListener('click', function () {

        let options = '<option value="">Producto</option>';

        productos.forEach(producto => {
            options += `
                <option value="${producto.id}">
                    ${producto.nombre} - ${producto.precio}€
                </option>
            `;
        });

        const html = `
        <div class="producto-item grid grid-cols-12 gap-3 mb-4 bg-gray-50 p-4 rounded-lg items-center">

            <div class="col-span-4">
                <select name="productos[${contador}][producto_id]"
                        class="w-full border rounded-lg px-3 py-2">
                    ${options}
                </select>
            </div>

            <div class="col-span-2">
                <input type="number"
                       name="productos[${contador}][cantidad]"
                       value="1"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="col-span-5">
                <input type="text"
                       name="productos[${contador}][notas]"
                       placeholder="Notas..."
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="col-span-1 flex justify-center">
                <button type="button"
                        class="delete-producto bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition">

                    Eliminar

                </button>
            </div>

        </div>
        `;

        container.insertAdjacentHTML('beforeend', html);

        contador++;
    });

    // ==========================
    // BORRAR PRODUCTO
    // ==========================
    container.addEventListener('click', function (e) {

        if (e.target.classList.contains('delete-producto')) {
            e.target.closest('.producto-item').remove();
        }

    });

</script>

@endsection