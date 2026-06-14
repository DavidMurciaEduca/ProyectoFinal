<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use SoftDeletes;
    protected $fillable = [
                        'nombre',
                        'descripcion',
                        'precio',
                        'categoria_id',
                        'imagen',
                        'activo'
                    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
