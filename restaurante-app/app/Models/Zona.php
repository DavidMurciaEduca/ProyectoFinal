<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable = [
                            'nombre'
                             ];
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }
    
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
