<?php

namespace App\Filament\Widgets;

use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Eps;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class EstadisticasPanel extends StatsOverviewWidget
{
    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        return [
            Stat::make('Pacientes Registrados', Cache::remember('pacientes_count', 60, fn () => Paciente::count()))
                ->icon('heroicon-o-user-group')
                ->color('success')
                ->description('Total de pacientes activos'),

            Stat::make('Citas de Hoy', Cache::remember('citas_hoy_count', 60, fn () => Cita::whereDate('fecha', today())->count()))
                ->icon('heroicon-o-calendar-days')
                ->color('primary')
                ->description('Citas programadas para hoy'),

            Stat::make('EPS Registradas', Cache::remember('eps_count', 60, fn () => Eps::count()))
                ->icon('heroicon-o-building-office')
                ->color('warning')
                ->description('Total de EPS y sedes activas'),
        ];
    }
}
