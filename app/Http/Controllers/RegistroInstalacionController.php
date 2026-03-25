<?php

namespace App\Http\Controllers;

use App\Models\RegistroInstalacion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroInstalacionController extends Controller
{
    public function index()
    {
        $registros = RegistroInstalacion::latest()->get();

        $total = $registros->count();
        $alertas = 0;

        foreach ($registros as $r) {
            if ($r->tipo_cobro == 'cobro') {
                $alertas++;
            }
        }

        return view('registros.index', compact('registros', 'total', 'alertas'));
    }

    public function create()
    {
        return view('registros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required',
            'serial_equipo' => 'required',
            'cantidad_ruedas' => 'required|integer',
            'fecha_instalacion' => 'required|date',
        ]);

        $serial = trim($request->serial_equipo);

        $ultimaInstalacion = RegistroInstalacion::where('serial_equipo', $serial)
            ->latest('fecha_instalacion')
            ->first();

        $tipoCobro = 'cobro';

        if ($ultimaInstalacion) {
            $fechaAnterior = Carbon::parse($ultimaInstalacion->fecha_instalacion);
            $fechaActual = Carbon::parse($request->fecha_instalacion);

            $meses = $fechaAnterior->diffInMonths($fechaActual);

            if ($meses >= 10) {
                $tipoCobro = 'cps';
            }
        }

        RegistroInstalacion::create([
            'empresa' => $request->empresa,
            'serial_equipo' => $serial,
            'cantidad_ruedas' => $request->cantidad_ruedas,
            'fecha_instalacion' => $request->fecha_instalacion,
            'tipo_cobro' => $tipoCobro,
            'observacion' => $request->observacion,
        ]);

        return redirect()->route('registros.index')
            ->with('success', 'Registro guardado correctamente');
    }

    public function buscarSerial($serial)
    {
        $serial = trim($serial);

        $registro = RegistroInstalacion::where('serial_equipo', $serial)
            ->latest('fecha_instalacion')
            ->first();

        if (!$registro) {
            return response()->json([
                'existe' => false
            ]);
        }

        $fechaAnterior = Carbon::parse($registro->fecha_instalacion);
        $hoy = Carbon::now();

        $meses = $fechaAnterior->diffInMonths($hoy);

        return response()->json([
            'existe' => true,
            'fecha' => $registro->fecha_instalacion,
            'empresa' => $registro->empresa,
            'estado' => $meses < 10 
                ? 'COBRAR (EN GARANTÍA)' 
                : 'CPS (ASUME EMPRESA)'
        ]);
    }
}