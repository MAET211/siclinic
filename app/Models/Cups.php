<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cups extends Model
{
    use HasFactory;

    protected $table = 'cups';

    protected $fillable = [
        'codigo',
        'nombre',
    ];

     public function citas(): HasMany
    {
     return $this->hasMany(Cita::class, 'cup_id'); 
    }

    public function especialidades()
    {
     return $this->belongsToMany(Especialidad::class, 'cups_especialidad', 'cups_id', 'especialidad_id');
    }


    // Accessors
    public function getCodigoCompletoAttribute(): string
    {
        return "{$this->codigo_cups} - {$this->nombre_procedimiento}";
    }

    // Métodos auxiliares
    public function getCantidadCitas($fechaInicio = null, $fechaFin = null)
    {
        $query = $this->citas();
        
        if ($fechaInicio && $fechaFin) {
            $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }
        
        return $query->count();
    }

    public function getCitasRealizadas()
    {
        return $this->citas()->where('estado', 'atendida')->count();
    }

    // Scopes
    public function scopeBuscar($query, $termino)
    {
        return $query->where('codigo', 'like', "%{$termino}%")
                    ->orWhere('nombre', 'like', "%{$termino}%");
    }
}