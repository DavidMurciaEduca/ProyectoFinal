<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{

    public function index()
    {
        $zonas = Zona::all();
        return view('zonas.index', compact('zonas'));
    }

    public function create()
    {
        return view('zonas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Zona::create($request->all());

        return redirect('/zonas')->with('success', 'Zona creada');
    }

    public function edit($id)
    {
        $zona = Zona::findOrFail($id);
        return view('zonas.edit', compact('zona'));
    }

    public function update(Request $request, $id)
    {
        $zona = Zona::findOrFail($id);

        $request->validate([
            'nombre' => 'required'
        ]);

        $zona->update($request->all());

        return redirect('/zonas')->with('success', 'Zona actualizada');
    }

    public function destroy($id)
    {
        Zona::destroy($id);
        return redirect('/zonas')->with('success', 'Zona eliminada');
    }
}
