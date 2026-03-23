<?php

namespace App\Http\Controllers;

use App\Models\RegistroInstalacion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroInstalacionController extends Controller
{
    // 👇 ESTE ES NUEVO
    public function index()
{
    $registros = RegistroInstalacion::latest()->get();

    $total = $registros->count();

    $alertas = 0;

    foreach ($registros as $r) {
        if (!$r->tipo_cobro && $r->fecha_ultima_instalacion) {
            $meses = \Carbon\Carbon::parse($r->fecha_ultima_instalacion)
                ->diffInMonths(\Carbon\Carbon::now());

            if ($meses < 10) {
                $alertas++;
            }
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
        // Validación básica
        $request->validate([
            'empresa' => 'required',
            'serial_equipo' => 'required',
            'cantidad_ruedas' => 'required|integer',
            'fecha_instalacion' => 'required|date',
        ]);

        // Lógica de cobro
        if ($request->tipo_cobro == 0 && $request->fecha_ultima_instalacion) {

            $fecha = Carbon::parse($request->fecha_ultima_instalacion);
            $hoy = Carbon::now();

            $meses = $fecha->diffInMonths($hoy);

            if ($meses < 10) {
                return back()->with('error', '⚠️ Debe ser COBRO (menos de 10 meses)');
            }
        }

        RegistroInstalacion::create($request->all());

        return redirect()->route('registros.index')
            ->with('success', 'Registro guardado correctamente');
    }
}