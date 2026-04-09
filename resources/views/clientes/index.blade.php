@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <h2 class="text-2xl font-bold mb-4">Clientes</h2>

    <!-- BUSCADOR -->
    <form method="GET" action="{{ route('clientes.index') }}" class="mb-4">
        <input type="text" name="buscar" placeholder="Buscar empresa o serial..."
            value="{{ request('buscar') }}"
            class="border px-4 py-2 rounded w-1/3">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Buscar
        </button>
    </form>

    <!-- BOTÓN -->
    <a href="{{ route('clientes.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded shadow">
       + Nuevo Cliente
    </a>

    <br><br>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Empresa</th>
                    <th class="p-3 text-left">Seriales</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody>

            @forelse($clientes as $cliente)

            <tr class="hover:bg-gray-50">
                <td class="p-3">{{ $cliente->empresa }}</td>
                
                <td class="p-3">
                    @foreach($cliente->seriales as $s)
                        <span class="bg-gray-200 px-2 py-1 rounded mr-1">
                            {{ $s->serial }}
                        </span>
                    @endforeach
                </td>

                <!-- 🔥 BOTÓN HISTORIAL -->
                <td class="p-3">
                    <a href="{{ route('consumo.historial', $cliente->id) }}" 
                       class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                        Ver historial
                    </a>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="3" class="text-center p-4">
                    No hay clientes registrados
                </td>
            </tr>
            @endforelse

            </tbody>
        </table>

    </div>

</div>

@endsection