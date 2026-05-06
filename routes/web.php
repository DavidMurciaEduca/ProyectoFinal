<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\MesaController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/productos', function () {
    return view('productos.index');
});
Route::get('/mesas', function () {
    return view('mesas.index');
});

Route::get('/usuarios', function () {
    return view('usuarios.index');
});
Route::resource('usuarios', UsuarioController::class);
Route::resource('zonas', ZonaController::class);
Route::resource('mesas', MesaController::class);