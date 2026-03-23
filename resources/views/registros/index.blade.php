@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <h2 class="text-2xl font-bold mb-4">Registros de Instalación</h2>

    <a href="{{ route('registros.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded shadow">
       + Nuevo Registro
    </a>

    <br><br>

    @php
        use Carbon\Carbon;
    @endphp

    {{-- ALERTA GENERAL --}}
    @php
        $hayAlerta = false;
        foreach($registros as $r){
            if (!$r->tipo_cobro && $r->fecha_ultima_instalacion) {
                $meses = Carbon::parse($r->fecha_ultima_instalacion)->diffInMonths(Carbon::now());
                if ($meses < 10) {
                    $hayAlerta = true;
                    break;
                }
            }
        }
    @endphp

    @if($hayAlerta)
        <div class="bg-red-500 text-white p-3 rounded mb-4 shadow">
            ⚠️ Hay equipos que deben pasar a COBRO
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Empresa</th>
                    <th class="p-3 text-left">Serial</th>
                    <th class="p-3 text-left">Cantidad</th>
                    <th class="p-3 text-left">Fecha</th>
                    <th class="p-3 text-left">Cobro</th>
                    <th class="p-3 text-left">Factura</th>
                    <th class="p-3 text-left">Estado</th>
                </tr>
            </thead>

            <tbody>

            @foreach($registros as $r)

            @php
                $alerta = false;

                if (!$r->tipo_cobro && $r->fecha_ultima_instalacion) {
                    $meses = Carbon::parse($r->fecha_ultima_instalacion)->diffInMonths(Carbon::now());

                    if ($meses < 10) {
                        $alerta = true;
                    }
                }
            @endphp

            <tr class="{{ $alerta ? 'bg-red-100' : 'hover:bg-gray-50' }}">
                <td class="p-3">{{ $r->empresa }}</td>
                <td class="p-3">{{ $r->serial_equipo }}</td>
                <td class="p-3">{{ $r->cantidad_ruedas }}</td>
                <td class="p-3">{{ $r->fecha_instalacion }}</td>
                <td class="p-3">
                    <span class="{{ $r->tipo_cobro ? 'text-green-600' : 'text-gray-600' }}">
                        {{ $r->tipo_cobro ? 'SI' : 'NO' }}
                    </span>
                </td>
                <td class="p-3">{{ $r->numero_factura }}</td>

                <td class="p-3">
                    @if($alerta)
                        <span class="bg-red-500 text-white px-2 py-1 rounded">
                            COBRAR
                        </span>
                    @else
                        <span class="bg-green-500 text-white px-2 py-1 rounded">
                            OK
                        </span>
                    @endif
                </td>
            </tr>

            @endforeach

            </tbody>
        </table>

    </div>

</div>

@endsection