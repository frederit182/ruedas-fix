@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <h2 class="text-2xl font-bold mb-4">Buscar Serial</h2>

    <form method="GET" action="{{ route('clientes.buscar') }}">
        <input type="text" name="serial" placeholder="Ej: 1234"
            class="border p-2 w-1/2">
        
        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Buscar
        </button>
    </form>

    <br>

    @if(isset($cliente) && $cliente)

        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-xl font-bold">
                Empresa: {{ $cliente->cliente->empresa }}
            </h3>

            <p class="mt-2 font-bold">Seriales:</p>

            @foreach($cliente->cliente->seriales as $s)
                <div class="bg-gray-200 px-2 py-1 rounded mb-1 inline-block">
                    {{ $s->serial }}
                </div>
            @endforeach
        </div>

    @elseif(isset($serialBuscado))

        <div class="bg-red-500 text-white p-3 rounded">
            No se encontró el serial
        </div>

    @endif

</div>

@endsection