<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita'; // <- esta línea es clave

    protected $fillable = [
        'id_paciente',
        'id_profesional',
        'fecha',
        'hora',
        'estado',
        'cup_id',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i:s',
    ];

    public const ESTADOS = [
        'pendiente' => 'Pendiente',
        'atendida' => 'Atendida',
        'cancelada' => 'Cancelada',
    ];

    // Relaciones
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function profesional(): BelongsTo
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }

    public function cups(): BelongsTo
    {
        return $this->belongsTo(Cups::class, 'cup_id');
    }

    // Accessors
    public function getFechaCompletaAttribute(): string
    {
        return $this->fecha->format('d/m/Y') . ' ' . 
               Carbon::parse($this->hora)->format('H:i');
    }

    public function getEstadoColorAttribute(): string
    {
        return match($this->estado) {
            'pendiente' => 'warning',
            'atendida' => 'success',
            'cancelada' => 'danger',
            default => 'secondary'
        };
    }

    // Scopes
    public function scopeHoy($query)
    {
        return $query->where('fecha', now()->toDateString());
    }

    public function scopeProximasSemana($query)
    {
        return $query->whereBetween('fecha', [
            now()->toDateString(),
            now()->addWeek()->toDateString()
        ]);
    }

    public function scopePorProfesional($query, $profesionalId)
    {
        return $query->where('id_profesional', $profesionalId);
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }
}
