<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\PedidoItem;
use App\Models\Zona;
use App\Models\User;
class PedidoController extends Controller
{
      // LISTAR
    public function index(Request $request)
    {
         $pedidos = Pedido::with(['mesa.zona', 'camarero', 'items.producto'])->latest();;

    if ($request->camarero_id) {
        $pedidos->where('camarero_id', $request->camarero_id);
    }

    if ($request->mesa_id) {
        $pedidos->where('mesa_id', $request->mesa_id);
    }

    if ($request->zona_id) {
        $pedidos->whereHas('mesa.zona', function ($q) use ($request) {
            $q->where('id', $request->zona_id);
        });
    }
    if ($request->estado) {
    $pedidos->where('estado', $request->estado);
    }
    if ($request->fecha) {
        $pedidos->whereDate('created_at', $request->fecha);
    }

    return view('pedidos.index', [
        'pedidos' => $pedidos->get(),
        'camareros' => User::where('tipo_usuario', 'camarero')->get(),
        'mesas' => Mesa::all(),
        'zonas' => Zona::all(),
    ]);
    }

    // FORM CREAR
    public function create()
    {
        //$zonas = Zona::with('mesas','')->get();
        $zonas = Zona::with([
                    'mesas',
                    'usuarios' => function ($query) {
                        $query->where('tipo_usuario', 'camarero')
                            ->where('activo', 1);
                    }
                ])->get();
        $productos = Producto::where('activo', true)->get();
   
        return view('pedidos.create',compact('zonas', 'productos'));
    }

    // GUARDAR PEDIDO
    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required',
            'user_id' => 'required',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);
        
        //dd($request->productos);
        // crear pedido
        $pedido = Pedido::create([
            'mesa_id' => $request->mesa_id,
            // temporal
            'camarero_id' => $request->user_id,
            'estado' => 'pendiente',
            'importe_total' => 0,
            'fecha_inicio' => now()
        ]);
        $pedido->mesa->update([
            'estado' => 'ocupada'
        ]);
        $total = 0;

        // recorrer productos
        foreach($request->productos as $productoData)
        {
            if(empty($productoData['producto_id']))
            {
                continue;
            }

            $producto = Producto::find($productoData['producto_id']);

            $cantidad = $productoData['cantidad'];

            $subtotal = $producto->precio * $cantidad;

            PedidoItem::create([

                'pedido_id' => $pedido->id,

                'producto_id' => $producto->id,

                'cantidad' => $cantidad,

                'precio_unitario' => $producto->precio,

                'notas' => $productoData['notas'] ?? null

            ]);

            $total += $subtotal;
        }

        // actualizar total
        $pedido->update([
            'importe_total' => $total
        ]);

        return redirect('/pedidos')
            ->with('success', 'Pedido creado');
    }
    // FORMULARIO EDITAR
public function edit($id)
{
    $pedido = Pedido::with('items')->findOrFail($id);

    $zonas = Zona::with([
    'mesas' => function ($query) use ($pedido) {

        $query->where('estado', 'libre')
              ->orWhere('id', $pedido->mesa_id);

    }
])->get();

    $productos = Producto::where('activo', true)->get();

    return view('pedidos.edit',
        compact('pedido', 'zonas', 'productos'));
}
// ACTUALIZAR PEDIDO
public function update(Request $request, $id)
{
    $request->validate([
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);
    $pedido = Pedido::findOrFail($id);


    // actualizar mesa y el estado
    if($pedido->estado != 'finalizado')
    {
        if ($pedido->mesa_id != $request->mesa_id) {

            // Mesa antigua
            $mesaAnteriorId = $pedido->mesa_id;

            // Liberar mesa antigua
            Mesa::find($mesaAnteriorId)->update([
                'estado' => 'libre'
            ]);

            // Cambiar mesa del pedido
            $pedido->update([
                'mesa_id' => $request->mesa_id
            ]);

            // Ocupar mesa nueva
            Mesa::find($request->mesa_id)->update([
                'estado' => 'ocupada'
            ]);
        }
        $pedido->update([

                'estado' => $request->estado

            ]);
        
         // eliminar items antiguos
    PedidoItem::where('pedido_id', $pedido->id)->delete();

    $total = 0;

    // crear nuevos items
    foreach($request->productos as $productoData)
    {
        if(empty($productoData['producto_id']))
        {
            dd("hhhhh");
            continue;
        }

        $producto = Producto::find($productoData['producto_id']);

        $cantidad = $productoData['cantidad'];

        PedidoItem::create([

            'pedido_id' => $pedido->id,

            'producto_id' => $producto->id,

            'cantidad' => $cantidad,

            'precio_unitario' => $producto->precio,

            'notas' => $productoData['notas'] ?? null

        ]);

        $total += $producto->precio * $cantidad;
    }

    // actualizar total
    $pedido->update([
        'importe_total' => $total
    ]);
    }
    else {
        $pedido->update([
                'estado' => $request->estado
            ]);
    }
    
    if($pedido->estado == 'finalizado')
    {
        $pedido->mesa->update([
            'estado' => 'libre'
        ]);
    }
    else
    {
        $pedido->mesa->update([
            'estado' => 'ocupada'
        ]);
    }
       
   

    return redirect('/pedidos')
        ->with('success', 'Pedido actualizado');
}
// ELIMINAR PEDIDO
public function destroy($id)
{
    $pedido = Pedido::findOrFail($id);

    // eliminar items
    PedidoItem::where('pedido_id', $pedido->id)->delete();
    $pedido->mesa->update([
        'estado' => 'libre'
        ]);
    // eliminar pedido
    $pedido->delete();

    return redirect('/pedidos')
        ->with('success', 'Pedido eliminado');
}
}
