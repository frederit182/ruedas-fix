<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroInstalacion extends Model
{
    protected $table = 'registros_instalacion';

    protected $fillable = [
        'empresa',
        'serial_equipo',
        'cantidad_ruedas',
        'fecha_instalacion',
        'tipo_cobro',
        'numero_factura',
        'fecha_ultima_instalacion',
        'observacion'
    ];
}