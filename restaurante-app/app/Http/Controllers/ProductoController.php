<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
class ProductoController extends Controller
{
    // LISTAR
    public function index(Request $request)
    {
        $query = Producto::with('categoria');
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

    
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }


        if ($request->filled('estado')) {
            $query->where('activo', $request->estado);
        }

        $productos = $query->get();

        $categorias = Categoria::all();

        return view('productos.index', compact('productos', 'categorias'));
    }

    // FORM CREAR
    public function create()
    {
        $categorias = Categoria::all();

        return view('productos.create', compact('categorias'));
    }

    // GUARDAR
    public function store(Request $request)
    {
         $request->validate([
        'nombre' => 'required',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $rutaImagen = null;

        // guardar imagen
        if ($request->hasFile('imagen')) {

            $rutaImagen = $request->file('imagen')
                ->store('productos', 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'imagen' => $rutaImagen,
            'activo' => $request->has('activo')
        ]);

        return redirect('/productos')
            ->with('success', 'Producto creado');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        $categorias = Categoria::all();

        return view('productos.edit',
            compact('producto', 'categorias'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $rutaImagen = $producto->imagen;

        // nueva imagen
        if ($request->hasFile('imagen')) {

            // eliminar antigua
            if ($producto->imagen) {

                Storage::disk('public')
                    ->delete($producto->imagen);
            }

            // guardar nueva
            $rutaImagen = $request->file('imagen')
                ->store('productos', 'public');
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'imagen' => $rutaImagen,
            'activo' => $request->has('activo')
        ]);

        return redirect('/productos')
            ->with('success', 'Producto actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Producto::destroy($id);

        return redirect('/productos')
            ->with('success', 'Producto eliminado');
    }
}
