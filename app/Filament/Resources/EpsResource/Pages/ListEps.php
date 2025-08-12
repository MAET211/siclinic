<?php

namespace App\Filament\Resources\EpsResource\Pages;

use App\Filament\Resources\EpsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEps extends ListRecords
{
    protected static string $resource = EpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
