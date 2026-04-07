<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'serials';

    public function cliente()
{
    return $this->belongsTo(Cliente::class, 'cliente_id');
}
    
}