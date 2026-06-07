<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Zona;
class UsuarioController extends Controller
{
    // LISTAR USUARIOS
    public function index()
    {
        $usuarios = User::with('zona')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        $zonas = Zona::all();
        return view('usuarios.create', compact('zonas'));
    }

    // GUARDAR USUARIO
   public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'tipo_usuario' => 'required'
        ]);

        // 🔥 SOLO camareros pueden tener zona
        $zonaId = null;

        if ($request->tipo_usuario === 'camarero') {
            $zonaId = $request->zona_id;
        }

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
            'activo' => true,
            'zona_id' => $zonaId
        ]);

        return redirect('/usuarios')->with('success', 'Usuario creado');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $zonas = Zona::all();
        return view('usuarios.edit', compact('usuario','zonas'));
    }

    // ACTUALIZAR USUARIO
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'tipo_usuario' => 'required'
        ]);
        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'tipo_usuario' => $request->tipo_usuario,
            'activo' => $request->activo ?? false,
            'zona_id' => (int)$request->zona_id == 0 ? null:(int)$request->zona_id
        ]);

        // actualizar contraseña solo si se envía
        if ($request->password) {
            $usuario->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect('/usuarios')->with('success', 'Usuario actualizado');
    }

    // ELIMINAR USUARIO
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/usuarios')->with('success', 'Usuario eliminado');
    }
    public function camareros()
    {
        return User::where('tipo_usuario', 'camarero')->get();
    }
    public function camarerosSinZona()
    {
        return User::where('tipo_usuario', 'camarero')
            ->whereNull('zona_id')
            ->get();
    }
}