@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4">

    <h2 class="text-2xl font-bold mb-4">Registrar Cliente</h2>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <!-- EMPRESA -->
        <div class="mb-4">
            <label class="block font-bold">Empresa</label>
            <input type="text" name="empresa" class="border p-2 w-full" required>
        </div>

        <!-- SERIALES -->
        <div class="mb-4">
            <label class="block font-bold">Seriales</label>

            <div id="contenedor-seriales">
                <div class="flex mb-2">
                    <input type="text" name="seriales[]" class="border p-2 w-full">
                    <button type="button" onclick="agregarSerial()" 
                        class="bg-green-500 text-white px-3 ml-2 rounded">
                        +
                    </button>
                </div>
            </div>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Guardar
        </button>

    </form>

</div>

<script>
function agregarSerial() {
    let contenedor = document.getElementById('contenedor-seriales');

    let div = document.createElement('div');
    div.classList.add('flex', 'mb-2');

    div.innerHTML = `
        <input type="text" name="seriales[]" class="border p-2 w-full">
        <button type="button" onclick="this.parentElement.remove()" 
            class="bg-red-500 text-white px-3 ml-2 rounded">
            -
        </button>
    `;

    contenedor.appendChild(div);
}
</script>

@endsection