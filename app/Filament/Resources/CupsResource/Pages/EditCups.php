<?php

namespace App\Filament\Resources\CupsResource\Pages;

use App\Filament\Resources\CupsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCups extends EditRecord
{
    protected static string $resource = CupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
