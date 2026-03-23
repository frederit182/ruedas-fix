@extends('layouts.app')

@section('content')

<h2>Nuevo Registro</h2>

@if(session('error'))
    <div style="background:red; color:white; padding:10px;">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div style="background:green; color:white; padding:10px;">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('registros.store') }}">
    @csrf

    <input type="text" name="empresa" placeholder="Empresa"><br><br>

    <input type="text" name="serial_equipo" placeholder="Serial equipo"><br><br>

    <input type="number" name="cantidad_ruedas" placeholder="Cantidad ruedas"><br><br>

    <label>Fecha instalación</label><br>
    <input type="date" name="fecha_instalacion"><br><br>

    <label>¿Es para cobro?</label><br>
    <select name="tipo_cobro" id="tipo_cobro">
        <option value="1">SI</option>
        <option value="0">NO</option>
    </select><br><br>

    <div id="factura_div">
        <input type="text" name="numero_factura" placeholder="Factura o cotización"><br><br>
    </div>

    <div id="no_cobro_div" style="display:none;">
        <label>Fecha última instalación</label><br>
        <input type="date" name="fecha_ultima_instalacion"><br><br>
    </div>

    <textarea name="observacion" placeholder="Observación"></textarea><br><br>

    <button type="submit">Guardar</button>
</form>

<script>
document.getElementById('tipo_cobro').addEventListener('change', function() {
    if (this.value == "1") {
        document.getElementById('factura_div').style.display = 'block';
        document.getElementById('no_cobro_div').style.display = 'none';
    } else {
        document.getElementById('factura_div').style.display = 'none';
        document.getElementById('no_cobro_div').style.display = 'block';
    }
});
</script>

@endsection