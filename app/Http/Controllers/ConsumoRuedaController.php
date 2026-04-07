<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Rueda;
use App\Models\ConsumoRueda;

class ConsumoRuedaController extends Controller
{
    public function create()
    {
        return view('consumos.create', [
            'clientes' => Cliente::all(),
            'equipos' => Equipo::all(),
            'ruedas' => Rueda::all(),
        ]);
    }

    public function store(Request $request)
    {
        // 1. VALIDACIÓN
        $request->validate([
            'cliente_id' => 'required',
            'equipo_id' => 'required',
            'rueda_id' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'cobrado' => 'required',
            'numero_cotizacion' => 'nullable',
            'observacion' => 'nullable',
        ]);

        // 2. BUSCAR RUEDA
        $rueda = Rueda::findOrFail($request->rueda_id);

        // 3. VALIDAR STOCK
        if ($rueda->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock');
        }

        // 4. CREAR CONSUMO
        ConsumoRueda::create([
            'cliente_id' => $request->cliente_id,
            'equipo_id' => $request->equipo_id,
            'rueda_id' => $request->rueda_id,
            'cantidad' => $request->cantidad,
            'fecha' => now(),
            'cobrado' => $request->cobrado,
            'numero_cotizacion' => $request->numero_cotizacion ?? null,
            'observacion' => $request->observacion ?? null,
        ]);

        // 5. DESCONTAR STOCK
        $rueda->stock -= $request->cantidad;
        $rueda->save();

        return back()->with('success', 'Consumo registrado correctamente');
        if ($rueda->stock <= 2) {
    return back()->with('success', 'Consumo registrado, ⚠ stock bajo: ' . $rueda->stock);
}
    }
}