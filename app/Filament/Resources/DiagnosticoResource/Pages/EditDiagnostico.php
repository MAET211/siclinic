<?php

namespace App\Filament\Resources\DiagnosticosResource\Pages;

use App\Filament\Resources\DiagnosticosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiagnosticos extends EditRecord
{
    protected static string $resource = DiagnosticosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
