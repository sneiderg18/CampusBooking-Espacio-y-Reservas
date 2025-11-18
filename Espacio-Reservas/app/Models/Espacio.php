<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Espacio extends Model
{
    protected $fillable = ['nombre', 'tipo', 'capacidad', 'ubicacion'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
