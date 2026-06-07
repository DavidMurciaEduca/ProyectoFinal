<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\MesaController;
use App\Http\Controllers\Api\PedidoController;
Route::post('/login', [AuthController::class, 'login']);

Route::get('/test', function () {
    return response()->json([
        'ok' => true,
        'message' => 'API funcionando'
    ]);
});
Route::get('/productos', function () {
    return \App\Models\Producto::all();
});
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/mesas/zona/{id}', [MesaController::class, 'porZona']);


Route::post('/pedidos', [PedidoController::class, 'store']);
Route::get('/mis-pedidos/{id}', [PedidoController::class, 'misPedidos']);
Route::get('/pedido/{id}', [PedidoController::class, 'show']);
Route::put('/pedidos/{id}', [PedidoController::class, 'update']);
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy']);
Route::put('/pedidos/{id}/finalizar',[PedidoController::class, 'finalizar']);
Route::put('/pedido/{id}/servir',[PedidoController::class, 'servirPlato']);
Route::get('/pedidos-cocina',[PedidoController::class, 'pedidosCocina']);
Route::put('/pedidos/{id}/estado',[PedidoController::class, 'cambiarEstado']);