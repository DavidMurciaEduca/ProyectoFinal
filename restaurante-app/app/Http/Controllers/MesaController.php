<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Zona;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mesa::with('zona');

        // FILTRO ZONA
        if ($request->zona_id) {
            $query->where('zona_id', $request->zona_id);
        }

        // FILTRO ESTADO
        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        $mesas = $query->get();

        // 👇 ESTO ES LO QUE TE FALTA
        $zonas = Zona::all();

        return view('mesas.index', compact('mesas', 'zonas'));
    }

    public function create()
    {
        $zonas = Zona::all();
        return view('mesas.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|integer',
            'zona' => 'required|exists:zonas,id',
            'capacidad' => 'required|integer|min:1',
        ]);

        Mesa::create([
            'numero' => $request->numero,
            'zona_id' => $request->zona,
            'capacidad' => $request->capacidad,
            'estado' => 'libre'
        ]);

        return redirect('/mesas')->with('success', 'Mesa creada');
    }

    public function edit($id)
    {
        $mesa = Mesa::findOrFail($id);
        $zonas = Zona::all();

        return view('mesas.edit', compact('mesa', 'zonas'));
    }

    public function update(Request $request, $id)
    {
        $mesa = Mesa::findOrFail($id);

        $request->validate([
            'numero' => 'required|integer',
            'zona_id' => 'required|exists:zonas,id',
            'capacidad' => 'required|integer|min:1',
            'estado' => 'required|in:libre,ocupada'
        ]);

        $mesa->update($request->all());

        return redirect('/mesas')->with('success', 'Mesa actualizada');
    }

    public function destroy($id)
    {
        Mesa::destroy($id);
        return redirect('/mesas')->with('success', 'Mesa eliminada');
    }
}
