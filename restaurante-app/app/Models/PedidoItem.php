<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_items';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'notas'
    ];

    // Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
