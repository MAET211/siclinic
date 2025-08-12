<?php

namespace App\Filament\Resources\ProfesionalEspecialidadResource\Pages;

use App\Filament\Resources\ProfesionalEspecialidadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfesionalEspecialidad extends EditRecord
{
    protected static string $resource = ProfesionalEspecialidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
