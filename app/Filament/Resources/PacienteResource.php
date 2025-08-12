<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Pacientes';
    protected static ?string $pluralLabel = 'Pacientes';
    protected static ?string $modelLabel = 'Paciente';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required()->maxLength(50),
                Forms\Components\TextInput::make('apellido')->required()->maxLength(50),
                Forms\Components\TextInput::make('documento')->required()->maxLength(20),
                Forms\Components\DatePicker::make('fecha_nacimiento')->required(),
                Forms\Components\TextInput::make('telefono')->tel()->maxLength(20),
                Forms\Components\TextInput::make('direccion')->maxLength(100),
                Forms\Components\Select::make('id_eps')
                    ->label('EPS')
                    ->relationship('eps', 'nombre_eps')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('apellido')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('documento')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')->date(),
                Tables\Columns\TextColumn::make('telefono'),
                Tables\Columns\TextColumn::make('direccion'),
                Tables\Columns\TextColumn::make('eps.nombre_eps')->label('EPS'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_eps')
                    ->label('EPS')
                    ->relationship('eps', 'nombre_eps')
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }
}
