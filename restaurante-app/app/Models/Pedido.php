<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'mesa_id',
        'camarero_id',
        'estado',
        'importe_total',
        'fecha_inicio',
        'fecha_preparado',
        'fecha_finalizado'
    ];

    // Mesa
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    // Camarero
    public function camarero()
    {
        return $this->belongsTo(User::class, 'camarero_id');
    }

    // Items
    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }

}
