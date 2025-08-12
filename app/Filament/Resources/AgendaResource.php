<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use App\Models\Especialidad;
use App\Models\Profesional;
use App\Models\Paciente;
use App\Models\Cups;
use App\Models\Horario;
use App\Models\Consultorio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Agendas';
    protected static ?string $pluralModelLabel = 'Agendas';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('fecha')->required(),
            Forms\Components\TimePicker::make('hora')->required(),

            Forms\Components\TextInput::make('nombre-especialidad')
                ->label('Especialidad')
                ->autocomplete(true)
                ->datalist(Especialidad::pluck('nombre_especialidad', 'id_especialidad')->all())
                ->required(),

            Forms\Components\TextInput::make('nombre-profesional')
                ->label('Profesional')
                ->autocomplete(true)
                ->datalist(Profesional::pluck('nombre', 'id_profesional')->all())
                ->required(),

            Forms\Components\TextInput::make('nombre-paciente')
                ->label('Paciente')
                ->autocomplete(true)
                ->datalist(Paciente::pluck('nombre', 'id_paciente')->all())
                ->required(),

            Forms\Components\TextInput::make('nombre-cups')
                ->label('CUPS')
                ->autocomplete(true)
                ->datalist(Cups::pluck('nombre', 'id')->all())
                ->required(),

            Forms\Components\TextInput::make('nombre-horario')
                ->label('Horario')
                ->autocomplete(true)
                ->datalist(Horario::pluck('hora_inicio', 'id')->all())
                ->required(),

            Forms\Components\TextInput::make('nombre-consultorio')
                ->label('Consultorio')
                ->autocomplete(true)
                ->datalist(Consultorio::pluck('nombre', 'id')->all())
                ->required(),

            Forms\Components\Select::make('estado')
                ->options([
                    'pendiente' => 'Pendiente',
                    'asistido' => 'Asistido',
                    'cancelado' => 'Cancelado',
                ])
                ->required(),

            Forms\Components\Textarea::make('observaciones'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('fecha')->sortable(),
            Tables\Columns\TextColumn::make('hora'),
            Tables\Columns\TextColumn::make('especialidad.nombre'),
            Tables\Columns\TextColumn::make('profesional.nombre'),
            Tables\Columns\TextColumn::make('paciente.nombre'),
            Tables\Columns\TextColumn::make('cups.nombre'),
            Tables\Columns\TextColumn::make('consultorio.nombre'),
            Tables\Columns\TextColumn::make('horario.nombre'),
            Tables\Columns\TextColumn::make('estado'),
        ])->defaultSort('fecha', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgenda::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}