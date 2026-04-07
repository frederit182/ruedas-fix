<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function historialCliente($cliente_id)
{
    $consumos = ConsumoRueda::where('cliente_id', $cliente_id)
        ->with(['equipo', 'rueda'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('consumos.historial', compact('consumos'));
}
}
