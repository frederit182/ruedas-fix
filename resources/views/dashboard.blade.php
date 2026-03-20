@extends('layouts.app')

@section('content')

<!-- TARJETAS -->
<div class="grid grid-cols-4 gap-6 mb-6">

    <div class="bg-blue-500 text-white p-5 rounded-2xl shadow-lg">
        <h3 class="text-sm">Ruedas en Stock</h3>
        <p class="text-3xl font-bold mt-2">15,230</p>
    </div>

    <div class="bg-green-500 text-white p-5 rounded-2xl shadow-lg">
        <h3 class="text-sm">Modelos</h3>
        <p class="text-3xl font-bold mt-2">340</p>
    </div>

    <div class="bg-orange-500 text-white p-5 rounded-2xl shadow-lg">
        <h3 class="text-sm">Clientes</h3>
        <p class="text-3xl font-bold mt-2">1,250</p>
    </div>

    <div class="bg-red-500 text-white p-5 rounded-2xl shadow-lg">
        <h3 class="text-sm">Órdenes</h3>
        <p class="text-3xl font-bold mt-2">78</p>
    </div>

</div>

<!-- GRÁFICA + LISTA -->
<div class="grid grid-cols-2 gap-6">

    <!-- Gráfica -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <h3 class="mb-4 font-semibold">Modelos más vendidos</h3>
        <canvas id="chart"></canvas>
    </div>

    <!-- Lista -->
    <div class="bg-white p-5 rounded-2xl shadow">
        <h3 class="mb-4 font-semibold">Productos recientes</h3>

        <ul class="space-y-4">
            <li class="flex items-center gap-3">
                <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded">
                <div>
                    <p class="font-semibold">Rueda Raptor</p>
                    <span class="text-sm text-gray-500">Alta resistencia</span>
                </div>
            </li>

            <li class="flex items-center gap-3">
                <img src="https://via.placeholder.com/50" class="w-12 h-12 rounded">
                <div>
                    <p class="font-semibold">Llanta Nitro</p>
                    <span class="text-sm text-gray-500">Uso urbano</span>
                </div>
            </li>
        </ul>
    </div>

</div>

@endsection