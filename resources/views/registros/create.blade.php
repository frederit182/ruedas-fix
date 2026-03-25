@extends('layouts.app')

@section('content')

<h2>Nuevo Registro</h2>

@if(session('success'))
    <div style="background:green; color:white; padding:10px;">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('registros.store') }}">
    @csrf

    <input type="text" name="empresa" placeholder="Empresa" required><br><br>

    <input type="text" name="serial_equipo" placeholder="Serial equipo" required><br><br>

    <div id="infoSerial" style="font-weight:bold;"></div><br>

    <input type="number" name="cantidad_ruedas" placeholder="Cantidad ruedas" required><br><br>

    <label>Fecha instalación</label><br>
    <input type="date" name="fecha_instalacion" value="{{ date('Y-m-d') }}" required><br><br>

    <textarea name="observacion" placeholder="Observación"></textarea><br><br>

    <button type="submit">Guardar</button>
</form>

<script>
const inputSerial = document.querySelector('input[name="serial_equipo"]');
const infoDiv = document.getElementById('infoSerial');

inputSerial.addEventListener('blur', function() {
    const serial = this.value.trim();

    if (!serial) return;

    fetch(`/buscar-serial/${serial}`)
        .then(res => res.json())
        .then(data => {

            if (!data.existe) {
                infoDiv.innerHTML = "🆕 Equipo nuevo (sin historial)";
                infoDiv.style.color = "blue";
                return;
            }

            let color = data.estado.includes('COBRAR') ? 'red' : 'green';

            infoDiv.innerHTML = `
                📅 Última instalación: ${data.fecha}<br>
                🏢 Empresa: ${data.empresa}<br>
                ⚠️ Estado: ${data.estado}
            `;

            infoDiv.style.color = color;
        });
});
</script>

@endsection