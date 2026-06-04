@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-xl p-8">

        <h1 class="text-3xl font-bold mb-8">
            Nuevo Pedido
        </h1>

        <form action="{{ route('pedidos.store') }}" method="POST">

            @csrf

            <!-- ZONA -->
            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Zona
                </label>

                <select id="zonaSelect"
                        name="zona_id"
                        class="w-full border rounded-lg px-4 py-3">

                    <option value=null>
                        Seleccionar zona
                    </option>

                    @foreach($zonas as $zona)

                        <option value="{{ $zona->id }}">
                            {{ $zona->nombre }}
                        </option>

                    @endforeach

                </select>
                
            </div>

            <!-- MESA -->
            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Mesa
                </label>

                <select name="mesa_id"
                        id="mesaSelect"
                        class="w-full border rounded-lg px-4 py-3">

                    <option value="">
                        Seleccionar mesa
                    </option>

                </select>
                @error('mesa_id')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
            <!-- Camarero -->
            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Camarero
                </label>

                <select name="user_id"
                        id="camareroSelect"
                        class="w-full border rounded-lg px-4 py-3">

                    <option value="">
                        Seleccionar Camarero
                    </option>

                </select>
                @error('user_id')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <!-- PRODUCTOS -->
            <h2 class="text-2xl font-bold mb-4">
                Productos
            </h2>

            <div id="productosContainer">

                <!-- Línea inicial -->

            <div class="producto-item grid grid-cols-12 gap-3 mb-4 bg-gray-50 p-4 rounded-lg items-center">                    <!-- Producto -->
                    <div class="col-span-4">

                        <select name="productos[0][producto_id]"
                                class="w-full border rounded-lg px-3 py-2">

                            <option value="">
                                Producto
                            </option>

                            @foreach($productos as $producto)

                                <option value="{{ $producto->id }}">
                                    {{ $producto->nombre }}
                                    - {{ $producto->precio }}€
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Cantidad -->
                    <div class="col-span-2">

                        <input type="number"
                               name="productos[0][cantidad]"
                               value="1"
                               class="w-full border rounded-lg px-3 py-2">

                    </div>

                    <!-- Notas -->
                    <div class="col-span-5">

                        <input type="text"
                               name="productos[0][notas]"
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
                @if ($errors->any())
                    <p class="text-red-500 text-sm mt-1">
                        Al menos tiene que eligir un producto
                    </p>
                @endif
            </div>

            <!-- BOTÓN AÑADIR -->
            <button type="button"
                    id="addProducto"
                    class="mt-3 mb-8 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">

                + Añadir producto

            </button>

            <!-- BOTÓN GUARDAR -->
            <div>

                <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">

                    Crear Pedido

                </button>

            </div>

        </form>

    </div>

</div>

<!-- JAVASCRIPT -->

<script>

    // ==========================
    // ZONAS Y MESAS
    // ==========================

    const zonas = @json($zonas);

    const zonaSelect = document.getElementById('zonaSelect');

    const mesaSelect = document.getElementById('mesaSelect');

    zonaSelect.addEventListener('change', function() {

        const zonaId = this.value;

        mesaSelect.innerHTML =
            '<option value="">Seleccionar mesa</option>';

        const zona = zonas.find(z => z.id == zonaId);

        if(zona)
        {
            zona.mesas.forEach(mesa => {
                if(mesa.estado == 'libre')
                {
                    mesaSelect.innerHTML += `
                        <option value="${mesa.id}">
                            Mesa ${mesa.numero}
                        </option>
                    `;
                }
            });
        }
    });



const camareroSelect = document.getElementById('camareroSelect');

zonaSelect.addEventListener('change', function() {

    const zonaId = this.value;

    camareroSelect.innerHTML =
        '<option value="">Seleccionar camarero</option>';

    const zona = zonas.find(z => z.id == zonaId);

    if (zona) {

        zona.usuarios.forEach(usuario => {

            camareroSelect.innerHTML += `
                <option value="${usuario.id}">
                    ${usuario.nombre}
                </option>
            `;

        });

    }

});
    // ==========================
    // PRODUCTOS DINÁMICOS
    // ==========================

    let contador = 1;

    const productos = @json($productos);

    document.getElementById('addProducto')
        .addEventListener('click', function() {

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
            <!-- Producto -->
            <div class="col-span-4">

                <select name="productos[${contador}][producto_id]"
                        class="w-full border rounded-lg px-3 py-2">

                    ${options}

                </select>

            </div>

            <!-- Cantidad -->
            <div class="col-span-2">

                <input type="number"
                       name="productos[${contador}][cantidad]"
                       value="1"
                       class="w-full border rounded-lg px-3 py-2">

            </div>

            <!-- Notas -->
            <div class="col-span-5">

                <input type="text"
                       name="productos[${contador}][notas]"
                       placeholder="Notas..."
                       class="w-full border rounded-lg px-3 py-2">

            </div>
            <!-- BORRAR -->
            <div class="col-span-1 flex justify-center">

                <button type="button"
                                class="delete-producto bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition">

                    Eliminar

                </button>

            </div>

        </div>
        `;

        document.getElementById('productosContainer')
            .insertAdjacentHTML('beforeend', html);

        contador++;
        // ==========================
        // BORRAR PRODUCTO
        // ==========================

        document.getElementById('productosContainer')
            .addEventListener('click', function(e) {

            if(e.target.classList.contains('delete-producto'))
            {
                e.target.closest('.producto-item').remove();
            }

        });
    });

</script>

@endsection