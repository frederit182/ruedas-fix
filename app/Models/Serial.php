<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    protected $fillable = [
        'cliente_id',
        'serial'
    ];
    public function cliente()
{
    return $this->belongsTo(Cliente::class);
}
}
