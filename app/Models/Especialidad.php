<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

        protected $primaryKey = 'id_especialidad';


    protected $fillable = [
        'nombre_especialidad',
    ];

    // Relaciones
    public function profesionales(): HasMany
    {
        return $this->hasMany(Profesional::class, 'id_especialidad');
    }

    public function cups()
    {
     return $this->belongsToMany(Cups::class, 'cups_especialidad', 'especialidad_id', 'cups_id');
    }


    public function profesionalEspecialidades(): HasMany
    {
        return $this->hasMany(ProfesionalEspecialidad::class, 'id_especialidad');
    }

    // Métodos auxiliares
    public function getProfesionalesActivos()
    {
        return $this->profesionales()->where('activo', true)->get();
    }

    public function getCantidadProfesionales()
    {
        return $this->profesionales()->count();
    }
}