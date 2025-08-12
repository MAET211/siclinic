<?php

namespace App\Filament\Resources\EpsResource\Pages;

use App\Filament\Resources\EpsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEps extends EditRecord
{
    protected static string $resource = EpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
