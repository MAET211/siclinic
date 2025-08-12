<?php

namespace App\Filament\Resources\ProfesionalEspecialidadResource\Pages;

use App\Filament\Resources\ProfesionalEspecialidadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfesionalEspecialidads extends ListRecords
{
    protected static string $resource = ProfesionalEspecialidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
