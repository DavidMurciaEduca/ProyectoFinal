<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\DashbordController;
/*
|--------------------------------------------------------------------------
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (Auth::check()) {

        $user = Auth::user();

        // SOLO admin y gerente
        if (
            $user->tipo_usuario == 'admin'
            ||
            $user->tipo_usuario == 'gerente'
        ) {
            return redirect('/dashboard');
        }

        // resto sin permiso
        Auth::logout();

        return redirect('/login')
            ->with('error', 'No tienes permiso para acceder al backend.');
    }

    return redirect('/login');

});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin.gerente'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | CRUDS
    |--------------------------------------------------------------------------
    */

    Route::resource('usuarios', UsuarioController::class);

    Route::resource('productos', ProductoController::class);

    Route::resource('pedidos', PedidoController::class);

    Route::resource('mesas', MesaController::class);

    Route::resource('categorias', CategoriaController::class);

    Route::resource('zonas', ZonaController::class);
    Route::get('/dashboard', [DashbordController::class, 'index'])
    ->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';