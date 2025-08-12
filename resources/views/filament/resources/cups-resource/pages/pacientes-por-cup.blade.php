<x-filament-panels::page>
    <x-filament::card>
        <x-slot name="header">
            <h2 class="text-xl font-bold">Pacientes con el código CUPS: {{ $codigoCup }}</h2>
        </x-slot>

        @if ($this->table->getRecords()->isEmpty())
            <p class="text-gray-500">No hay pacientes con este procedimiento.</p>
        @else
            <table class="min-w-full mt-4 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Paciente</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Fecha</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Estado</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($this->table->getRecords() as $cita)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                            <td class="px-4 py-2 text-sm">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-sm">{{ ucfirst($cita->estado) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-filament::card>
</x-filament-panels::page>
