@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Agregar al Inventario</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('inventario.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Proveedor</label>
            <input type="text" name="proveedor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Referencia de Rueda</label>
            <input type="text" name="referencia_rueda" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha de Compra</label>
            <input type="date" name="fecha_compra" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Factura</label>
            <input type="text" name="factura" class="form-control">
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>
@endsection