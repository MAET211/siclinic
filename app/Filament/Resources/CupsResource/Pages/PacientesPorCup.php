<?php

namespace App\Filament\Resources\CupsResource\Pages;

use App\Filament\Resources\CupsResource;
use App\Models\Cita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PacientesPorCup extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = CupsResource::class;

    protected static string $view = 'filament.resources.cups-resource.pages.pacientes-por-cup';

    public ?string $codigoCup = null;

    // Renderiza el formulario de búsqueda en la parte superior
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('codigoCup')
                ->label('Código CUPS')
                ->placeholder('Ej: 992101')
                ->required()
                ->live(debounce: 500)
                ->afterStateUpdated(fn () => $this->resetTable()),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Cita::query()
                ->when($this->codigoCup, function ($query) {
                    $query->whereHas('cups', function ($q) {
                        $q->where('codigo_cups', $this->codigoCup);
                    });
                })
                ->with('paciente'))
            ->columns([
                Tables\Columns\TextColumn::make('paciente.nombre')->label('Nombre del Paciente'),
                Tables\Columns\TextColumn::make('paciente.apellido')->label('Apellido'),
                Tables\Columns\TextColumn::make('fecha')->label('Fecha de la Cita'),
                Tables\Columns\TextColumn::make('estado')->label('Estado'),
            ])
            ->emptyStateHeading('No se encontraron pacientes')
            ->emptyStateDescription('Intenta con otro código CUPS.');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
