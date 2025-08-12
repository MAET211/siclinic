<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Profesional extends Model
{
    use HasFactory;

    protected $table = 'profesionales';

    protected $primaryKey = 'id_profesional';

    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'correo',
        'id_especialidad',
    ];

    // Relaciones
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'id_profesional');
    }

    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }

    public function profesionalEspecialidades(): HasMany
    {
        return $this->hasMany(ProfesionalEspecialidad::class, 'id_profesional');
    }

    // Accessors
    public function getNombreCompletoAttribute(): string
    {
        return $this->nombre;
    }

    // Métodos para horarios disponibles
    public function getHorariosDisponibles(string $fecha): array
    {
        // Horarios estándar (puedes personalizar según tus necesidades)
        $horariosBase = [
            '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '14:00', '14:30', '15:00', '15:30',
            '16:00', '16:30', '17:00', '17:30'
        ];

        // Obtener citas ocupadas en esa fecha
        $citasOcupadas = $this->citas()
            ->where('fecha', $fecha)
            ->whereIn('estado', ['pendiente', 'atendida'])
            ->pluck('hora')
            ->map(function ($hora) {
                return Carbon::parse($hora)->format('H:i');
            })
            ->toArray();

        // Filtrar horarios disponibles
        return array_diff($horariosBase, $citasOcupadas);
    }

    public function tieneDisponibilidad(string $fecha, string $hora): bool
    {
        $horariosDisponibles = $this->getHorariosDisponibles($fecha);
        return in_array($hora, $horariosDisponibles);
    }

    public function getCitasHoy()
    {
        return $this->citas()
            ->where('fecha', now()->toDateString())
            ->orderBy('hora')
            ->get();
    }

    public function getCitasPendientesHoy()
    {
        return $this->citas()
            ->where('fecha', now()->toDateString())
            ->where('estado', 'pendiente')
            ->orderBy('hora')
            ->get();
    }

    public function getProximasCitas($dias = 7)
    {
        return $this->citas()
            ->whereBetween('fecha', [
                now()->toDateString(),
                now()->addDays($dias)->toDateString()
            ])
            ->where('estado', 'pendiente')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();
    }

    // Estadísticas
    public function getCitasAtendidas($mes = null, $año = null)
    {
        $query = $this->citas()->where('estado', 'atendida');
        
        if ($mes && $año) {
            $query->whereMonth('fecha', $mes)
                  ->whereYear('fecha', $año);
        }
        
        return $query->count();
    }

    public function getCitasCanceladas($mes = null, $año = null)
    {
        $query = $this->citas()->where('estado', 'cancelada');
        
        if ($mes && $año) {
            $query->whereMonth('fecha', $mes)
                  ->whereYear('fecha', $año);
        }
        
        return $query->count();
    }
}