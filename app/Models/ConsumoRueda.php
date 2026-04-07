<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumoRueda extends Model
{
    protected $fillable = [
    'cliente_id',
    'equipo_id',
    'rueda_id',
    'cantidad',
    'fecha',
    'cobrado',
    'numero_cotizacion',
    'observacion'
];
}
