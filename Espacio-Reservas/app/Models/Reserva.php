<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['espacio_id', 'solicitante', 'fecha', 'hora_inicio', 'hora_fin', 'motivo', 'cantidad_personas'];

    public function espacio()
    {
        return $this->belongsTo(Espacio::class);
    }
}
