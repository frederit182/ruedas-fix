<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'empresa'
    ];

    public function seriales()
    {
        return $this->hasMany(Serial::class);
    }
}
