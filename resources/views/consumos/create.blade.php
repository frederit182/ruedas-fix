<h2>Consumo de Ruedas</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('consumos.store') }}">
    @csrf

    <label>Cliente</label>
    <select id="cliente" name="cliente_id">
        <option value="">Seleccione cliente</option>
        @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">
                {{ $cliente->empresa }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Equipo</label>
    <select id="equipo" name="equipo_id">
        <option value="">Seleccione equipo</option>
    </select>

    <br><br>

    <label>Rueda</label>
    <select name="rueda_id">
        @foreach($ruedas as $rueda)
            <option value="{{ $rueda->id }}">
                {{ $rueda->referencia }} (Stock: {{ $rueda->stock }})
            </option>
        @endforeach
    </select>

    <br><br>

    <input type="number" name="cantidad" placeholder="Cantidad">

    <br><br>

    <select name="cobrado">
        <option value="1">Sí</option>
        <option value="0">No</option>
    </select>

    <br><br>

    <input type="text" name="numero_cotizacion" placeholder="Cotización">

    <br><br>

    <textarea name="observacion" placeholder="Observación"></textarea>

    <br><br>

    <button type="submit">Guardar</button>
</form>
<script>
document.getElementById('cliente').addEventListener('change', function() {
    let clienteId = this.value;

    fetch('/equipos/' + clienteId)
        .then(res => res.json())
        .then(data => {
            let equipoSelect = document.getElementById('equipo');

            equipoSelect.innerHTML = '<option value="">Seleccione equipo</option>';

            data.forEach(equipo => {
                equipoSelect.innerHTML += `
                    <option value="${equipo.id}">
                        ${equipo.serial}
                    </option>`;
            });
        });
});
</script>