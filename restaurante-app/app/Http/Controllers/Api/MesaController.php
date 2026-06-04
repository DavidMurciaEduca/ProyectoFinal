<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mesa;

class MesaController extends Controller
{
    
    public function porZona($id)
    {

        return Mesa::where('zona_id', $id)
            ->where('estado', 'libre')
            ->get();

    }

}
