<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PedidoItem;

class dashbordController extends Controller
{
    public function index(Request $request)
{
    // filtro
    $filtro = $request->filtro ?? 'hoy';

    // query pedidos finalizados
    $query = Pedido::where('estado', 'finalizado');

    // HOY
    if ($filtro == 'hoy') {

        $query->whereDate('created_at', Carbon::today());
    }

    // SEMANA
    elseif ($filtro == 'semana') {

        $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    // MES
    elseif ($filtro == 'mes') {

        $query->whereMonth('created_at', Carbon::now()->month)
              ->whereYear('created_at', Carbon::now()->year);
    }

    // ingresos por camarero
    $ingresosPorCamarero = $query
        ->select(
            'camarero_id',
            DB::raw('SUM(importe_total) as total')
        )
        ->groupBy('camarero_id')
        ->with('camarero')
        ->get();

    // total global
    $totalIngresos = $ingresosPorCamarero->sum('total');

    $ventasEstrella = PedidoItem::query()

    ->join('pedidos', 'pedido_items.pedido_id', '=', 'pedidos.id')

    ->join('productos', 'pedido_items.producto_id', '=', 'productos.id')

    ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')

    ->join('users', 'pedidos.camarero_id', '=', 'users.id')

    ->where('pedidos.estado', 'finalizado')

    ->where('categorias.nombre','Plato estrella / Bebida estrella');

    if ($filtro == 'hoy') {

    $ventasEstrella->whereDate(
        'pedidos.created_at',
        Carbon::today()
    );

    }
    elseif ($filtro == 'semana') {

        $ventasEstrella->whereBetween(
            'pedidos.created_at',
            [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]
        );

    }
    elseif ($filtro == 'mes') {

        $ventasEstrella
            ->whereMonth(
                'pedidos.created_at',
                Carbon::now()->month
            )
            ->whereYear(
                'pedidos.created_at',
                Carbon::now()->year
            );

    }
    $ventasEstrella = $ventasEstrella
    ->select(
        'users.nombre',
            DB::raw('SUM(pedido_items.cantidad) as total_vendidos')
    )

    ->groupBy(
        'users.id',
        'users.nombre'
    )

    ->orderByDesc('total_vendidos')

    ->get();
    $totalPlatosEstrella = $ventasEstrella->sum('total_vendidos');
    return view('dashboard', compact(
        'ingresosPorCamarero',
        'totalIngresos',
        'ventasEstrella',
        'totalPlatosEstrella',
        'filtro'
    ));
}
}
