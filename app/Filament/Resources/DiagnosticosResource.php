<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiagnosticosResource\Pages;
use App\Models\Diagnostico;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DiagnosticosResource extends Resource
{
    protected static ?string $model = Diagnostico::class;

    protected static ?string $navigationLabel = 'Diagnósticos';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Parámetros';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->label('Código')->searchable(),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('extra_v')->label('Extra V'),
                Tables\Columns\TextColumn::make('edad_minima')->label('Edad Mínima'),
                Tables\Columns\TextColumn::make('edad_maxima')->label('Edad Máxima'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiagnosticos::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}
