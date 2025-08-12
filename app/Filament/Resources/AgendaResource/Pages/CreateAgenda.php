<?php

namespace App\Filament\Resources\AgendaResource\Pages;

use App\Filament\Resources\AgendaResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Paciente;
use App\Models\Especialidad;
use App\Models\Profesional;
use App\Models\Cups;
use App\Models\Horario;
use App\Models\Consultorio;

class CreateAgenda extends CreateRecord
{
    protected static string $resource = AgendaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['paciente_id'] = Paciente::where('nombre', $data['nombre-paciente'])->value('id_paciente');
        $data['especialidad_id'] = Especialidad::where('nombre_especialidad', $data['nombre-especialidad'])->value('id_especialidad');
        $data['profesional_id'] = Profesional::where('nombre', $data['nombre-profesional'])->value('id_profesional');
        $data['cups_id'] = Cups::where('nombre', $data['nombre-cups'])->value('id');
        $data['horario_id'] = Horario::where('descripcion', trim($data['nombre-horario']))->value('id');
        $data['consultorio_id'] = Consultorio::where('nombre', $data['nombre-consultorio'])->value('id');

        unset(
            $data['nombre-paciente'],
            $data['nombre-especialidad'],
            $data['nombre-profesional'],
            $data['nombre-cups'],
            $data['nombre-horario'],
            $data['nombre-consultorio']
        );

        return $data;
    }
}
