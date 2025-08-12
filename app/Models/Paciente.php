<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Paciente extends Model
{
    use HasFactory;

    // 🔧 Corrección clave primaria personalizada
    protected $primaryKey = 'id_paciente';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'id_eps',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    // Relaciones
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'id_paciente');
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(Eps::class, 'id_eps');
    }

    // Accessors
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function getEdadAttribute(): int
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    // Métodos auxiliares
    public function getUltimaCita()
    {
        return $this->citas()
            ->where('estado', 'atendida')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->first();
    }

    public function getProximaCita()
    {
        return $this->citas()
            ->where('estado', 'pendiente')
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->first();
    }

    public function getCitasPendientes()
    {
        return $this->citas()
            ->where('estado', 'pendiente')
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();
    }

    public function getHistorialCitas($limite = 10)
    {
        return $this->citas()
            ->with(['profesional', 'cups'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->limit($limite)
            ->get();
    }
}
