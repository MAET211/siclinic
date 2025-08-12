<h1>Lista de Pacientes</h1>

<a href="{{ route('pacientes.create') }}">Registrar Paciente</a>

<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Documento</th>
        <th>EPS</th>
        <th>Teléfono</th>
    </tr>
    @foreach ($pacientes as $paciente)
    <tr>
        <td>{{ $paciente->nombre }}</td>
        <td>{{ $paciente->documento }}</td>
        <td>{{ $paciente->eps->nombre_eps }}</td>
        <td>{{ $paciente->telefono }}</td>
    </tr>
    @endforeach
</table>
