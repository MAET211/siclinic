<h1>Registrar Paciente</h1>

<form action="{{ route('pacientes.store') }}" method="POST">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label>Documento:</label>
    <input type="text" name="documento" required><br>

    <label>Fecha de nacimiento:</label>
    <input type="date" name="fecha_nacimiento" required><br>

    <label>Teléfono:</label>
    <input type="text" name="telefono" required><br>

    <label>Dirección:</label>
    <input type="text" name="direccion" required><br>

    <label>EPS:</label>
    <select name="id_eps" required>
        @foreach ($eps as $e)
            <option value="{{ $e->id_eps }}">{{ $e->nombre_eps }}</option>
        @endforeach
    </select><br>

    <button type="submit">Guardar</button>
</form>
