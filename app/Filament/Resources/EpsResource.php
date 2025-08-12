<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EpsResource\Pages;
use App\Models\Eps;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class EpsResource extends Resource
{
    protected static ?string $model = Eps::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Administracion';
    protected static ?string $pluralModelLabel = 'sedes';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre_eps')
                    ->label('Nombre de la EPS')
                    ->required()
                    ->maxLength(100),

                TextInput::make('nit')
                    ->label('NIT')
                    ->required()
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_eps')
                    ->label('Nombre EPS')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nit')
                    ->label('NIT')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pacientes_count')
                    ->label('Pacientes')
                    ->counts('pacientes')
                    ->sortable(),
            ])
            ->filters([])

            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Puedes incluir RelationManagers aquí si agregas relaciones
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEps::route('/'),
            'create' => Pages\CreateEps::route('/create'),
            'edit' => Pages\EditEps::route('/{record}/edit'),
        ];
    }
}
