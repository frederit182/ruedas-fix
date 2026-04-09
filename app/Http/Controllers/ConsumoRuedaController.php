<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsumoRueda;
use App\Models\Cliente;
use App\Models\InventarioRueda;

class ConsumoRuedaController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        $ruedas = InventarioRueda::all();

        return view('consumo.create', compact('clientes', 'ruedas'));
    }

    public function store(Request $request)
    {
        $rueda = InventarioRueda::where('referencia_rueda', $request->referencia_rueda)->first();

        if (!$rueda || $rueda->cantidad < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock');
        }

        ConsumoRueda::create($request->all());

        $rueda->cantidad -= $request->cantidad;
        $rueda->save();

        return back()->with('success', 'Consumo registrado');
    }

    // 🔥 HISTORIAL POR CLIENTE CON FILTRO
    public function historialCliente(Request $request, $cliente_id)
    {
        $query = ConsumoRueda::where('cliente_id', $cliente_id);

        // 🔍 FILTRO POR FECHA
        if ($request->desde) {
            $query->whereDate('fecha', '>=', $request->desde);
        }

        if ($request->hasta) {
            $query->whereDate('fecha', '<=', $request->hasta);
        }

        $consumos = $query->orderBy('fecha', 'desc')->get();

        $cliente = Cliente::find($cliente_id);

        $totalRuedas = $consumos->sum('cantidad');

        return view('consumo.historial', compact('consumos', 'cliente', 'totalRuedas'));
    }
}