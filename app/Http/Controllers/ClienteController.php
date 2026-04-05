<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Serial; // 👈 IMPORTANTE
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->buscar;

    $clientes = Cliente::with('seriales')
        ->when($buscar, function ($query) use ($buscar) {
            $query->where('empresa', 'like', "%$buscar%")
                  ->orWhereHas('seriales', function ($q) use ($buscar) {
                      $q->where('serial', 'like', "%$buscar%");
                  });
        })
        ->get();

    return view('clientes.index', compact('clientes'));
}
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // Crear cliente
        $cliente = Cliente::create([
            'empresa' => $request->empresa
        ]);

        // Guardar seriales
        if ($request->seriales) {
            foreach ($request->seriales as $serial) {
                if ($serial) {
                    Serial::create([
                        'cliente_id' => $cliente->id,
                        'serial' => $serial
                    ]);
                }
            }
        }

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente');
    }
    public function buscar(Request $request)
{
    $serialBuscado = $request->serial;

    $cliente = \App\Models\Serial::where('serial', $serialBuscado)
        ->with('cliente')
        ->first();

    return view('clientes.buscar', compact('cliente', 'serialBuscado'));
}
}
