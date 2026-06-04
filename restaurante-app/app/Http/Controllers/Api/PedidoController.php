<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Mesa;
use App\Models\PedidoItem;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);
        // 1. CREAR PEDIDO
        $pedido = Pedido::create([
            'mesa_id' => $request->mesa_id,
            'camarero_id' => $request->usuario_id, // mejor que fijo
            'estado' => 'pendiente',
            'importe_total' => 0,
            'fecha_inicio' => now()
        ]);

        // 2. CAMBIAR ESTADO MESA
        $pedido->mesa->update([
            'estado' => 'ocupada'
        ]);

        $total = 0;

        // 3. CREAR ITEMS
        foreach ($request->productos as $productoData) {

            $producto = Producto::find($productoData['producto_id']);

            if (!$producto) continue;

            $cantidad = $productoData['cantidad'];
            $subtotal = $producto->precio * $cantidad;

            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio,
                'notas' => $productoData['notas'] ?? null,
                'estado' => 'pendiente'
            ]);

            $total += $subtotal;
        }

        // 4. ACTUALIZAR TOTAL
        $pedido->update([
            'importe_total' => $total
        ]);

        return response()->json([
            'message' => 'Pedido creado correctamente',
            'pedido' => $pedido
        ]);
    }

    public function misPedidos($id)
    {
        $pedidos = Pedido::with('mesa')

            ->where('camarero_id', $id)

            ->whereDate('created_at', today())

            ->orderBy('id', 'desc')

            ->get();

        $totalFinalizados = Pedido::where('camarero_id', $id)

            ->where('estado', 'finalizado')

            ->whereDate('created_at', today())

            ->sum('importe_total');

        return response()->json([
            'pedidos' => $pedidos,
            'total_finalizados' => $totalFinalizados
        ]);
    }
    public function show($id)
    {
        $pedido = Pedido::with([
            'mesa',
            'items.producto'
        ])->findOrFail($id);

        return response()->json($pedido);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);
        $pedido = Pedido::findOrFail($id);
        if($request->mesa_id != $pedido->mesa_id)
        {
            Mesa::find($request->mesa_id)?->update([
                'estado' => 'ocupada'
            ]);
            Mesa::find($pedido->mesa_id)?->update([
                'estado' => 'libre'
            ]);
        }
        // actualizar mesa
        $pedido->update([
            'mesa_id' => $request->mesa_id
        ]);

        // borrar items viejos
        PedidoItem::where('pedido_id', $pedido->id)
            ->delete();

        $total = 0;

        // crear nuevos items
        foreach($request->productos as $item)
        {
            $producto = Producto::find($item['producto_id']);

            PedidoItem::create([

                'pedido_id' => $pedido->id,

                'producto_id' => $producto->id,

                'cantidad' => $item['cantidad'],

                'precio_unitario' => $producto->precio,

                'notas' => $item['notas'],

                'estado' => 'pendiente'

            ]);

            $total +=
                $producto->precio
                *
                $item['cantidad'];
        }
        $pedido->update([
            'importe_total' => $total
        ]);

        return response()->json([
            'message' => 'Pedido actualizado'
        ]);
    }
public function destroy($id)
{
    $pedido = Pedido::findOrFail($id);
     $mesa = $pedido->mesa;
    $pedido->items()->delete();
    $pedido->delete();
    if ($mesa) {
        $mesa->update([
            'estado' => 'libre'
        ]);
    }
    return response()->json([
        'message' => 'Pedido eliminado'
    ]);
}
public function finalizar($id)
{
    $pedido = Pedido::findOrFail($id);

    // cambiar estado pedido
    $pedido->update([
        'estado' => 'finalizado',
        'fecha_fin' => now()
    ]);

    // liberar mesa
    $pedido->mesa->update([
        'estado' => 'libre'
    ]);

    return response()->json([
        'message' => 'Pedido finalizado correctamente'
    ]);
}
public function servirPlato($id)
{
    $pedido = Pedido::findOrFail($id);

    $pedido->update([
        'estado' => 'servido'
    ]);

    return response()->json([
        'message' => 'Plato servido'
    ]);
}
public function pedidosCocina()
{
    $pedidos = Pedido::with([
        'mesa',
        'items.producto',
        'camarero'
    ])

    ->whereDate(
        'created_at',
        today()
    )

    ->orderBy('id', 'desc')

    ->get();

    return response()->json($pedidos);
}
public function cambiarEstado(
    Request $request,
    $id
)
{
    $pedido = Pedido::findOrFail($id);

    $pedido->update([
        'estado' => $request->estado
    ]);

    return response()->json([
        'message' => 'Estado actualizado'
    ]);
}
}
