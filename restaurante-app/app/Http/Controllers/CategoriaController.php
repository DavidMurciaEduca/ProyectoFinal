<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
class CategoriaController extends Controller
{
     // LISTAR
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    // FORM CREAR
    public function create()
    {
        return view('categorias.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Categoria::create([
            'nombre' => $request->nombre
        ]);

        return redirect('/categorias')
            ->with('success', 'Categoría creada');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required'
        ]);

        $categoria->update([
            'nombre' => $request->nombre
        ]);

        return redirect('/categorias')
            ->with('success', 'Categoría actualizada');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Categoria::destroy($id);

        return redirect('/categorias')
            ->with('success', 'Categoría eliminada');
    }
}
