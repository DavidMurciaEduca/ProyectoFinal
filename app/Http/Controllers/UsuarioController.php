<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // LISTAR USUARIOS
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        return view('usuarios.create');
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

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
            'activo' => true
        ]);

        return redirect('/usuarios')->with('success', 'Usuario creado');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
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
            'activo' => $request->activo
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
}