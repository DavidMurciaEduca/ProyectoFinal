<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = [
    'numero',
    'zona_id',
    'capacidad',
    'estado'
    ];
    public function zona()
    {
       return $this->belongsTo(Zona::class);
    }
}
