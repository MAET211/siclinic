<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CupsResource\Pages;
use App\Filament\Resources\CupsResource\RelationManagers;
use App\Models\Cups;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CupsResource extends Resource
{
    protected static ?string $model = Cups::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'CUPS';

    protected static ?string $navigationGroup = 'Parámetros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('anio')
                    ->required()
                    ->maxLength(4)
                    ->label('Año'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anio')
                    ->label('Año'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('verPacientes')
                    ->label('Ver pacientes')
                    ->icon('heroicon-o-users')
                    ->modalHeading('Pacientes por CUPS')
                    ->modalSubmitAction(false)
                    ->slideOver()
                    ->form([ // dejar el formulario vacío, se llena dinámicamente
                        Forms\Components\Repeater::make('pacientes')
                            ->label('Pacientes con este CUPS')
                            ->schema([
                                Forms\Components\TextInput::make('nombre')->label('Paciente')->disabled(),
                                Forms\Components\TextInput::make('fecha')->label('Fecha')->disabled(),
                                Forms\Components\TextInput::make('estado')->label('Estado')->disabled(),
                            ])
                            ->columns(3)
                            ->disabled(),
                    ])
                    ->mountUsing(function ($record, $form) {
                        $pacientes = $record->citas()->with('paciente')->get()->map(function ($cita) {
                            if (!$cita->paciente) return null; // evitar errores si no hay relación
                            return [
                                'nombre' => $cita->paciente->nombre . ' ' . $cita->paciente->apellido,
                                'fecha' => $cita->fecha->format('d/m/Y'),
                                'estado' => ucfirst($cita->estado),
                            ];
                        })->filter()->values();

                        $form->fill([
                            'pacientes' => $pacientes,
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCups::route('/'),
            'create' => Pages\CreateCups::route('/create'),
            'edit' => Pages\EditCups::route('/{record}/edit'),
        ];
    }
}
