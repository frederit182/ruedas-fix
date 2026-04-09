@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <h2 class="text-2xl font-bold mb-2">
        Historial - {{ $cliente->empresa }}
    </h2>

    <!-- 🔥 TOTAL -->
    <div class="bg-blue-100 text-blue-800 p-3 rounded mb-4">
        Total ruedas consumidas: <strong>{{ $totalRuedas }}</strong>
    </div>

    <!-- FILTRO POR FECHA -->
    <form method="GET" class="mb-4 flex gap-2">
        <input type="date" name="desde" class="border p-2 rounded">
        <input type="date" name="hasta" class="border p-2 rounded">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Filtrar
        </button>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Fecha</th>
                    <th class="p-3">Equipo</th>
                    <th class="p-3">Rueda</th>
                    <th class="p-3">Cantidad</th>
                    <th class="p-3">Cobro</th>
                    <th class="p-3">Documento</th>
                    <th class="p-3">Observación</th>
                </tr>
            </thead>

            <tbody>
            @forelse($consumos as $c)
                <tr class="border-t text-center">
                    <td class="p-2">{{ $c->fecha }}</td>
                    <td class="p-2">{{ $c->equipo }}</td>
                    <td class="p-2">{{ $c->referencia_rueda }}</td>
                    <td class="p-2">{{ $c->cantidad }}</td>

                    <td class="p-2">
                        @if($c->cobro)
                            <span class="text-green-600 font-bold">Sí</span>
                        @else
                            <span class="text-red-600 font-bold">No</span>
                        @endif
                    </td>

                    <td class="p-2">
                        {{ $c->numero_documento ?? '-' }}
                    </td>

                    <td class="p-2">
                        {{ $c->observacion ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4 text-center">
                        No hay registros
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection