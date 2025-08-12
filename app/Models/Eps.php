<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Eps extends Model
{
    use HasFactory;

    protected $table = 'eps';

        protected $primaryKey = 'id_eps';


    protected $fillable = [
        'nombre_eps',
        'nit',
    ];

    // Relaciones
    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class, 'id_eps');
    }

    // Métodos auxiliares
    public function getCantidadPacientes()
    {
        return $this->pacientes()->count();
    }

    public function getPacientesActivos()
    {
        return $this->pacientes()->where('activo', true)->count();
    }

    // Accessors
    public function getNombreCompletoAttribute(): string
    {
        return $this->nit ? "{$this->nombre_eps} - {$this->nit}" : $this->nombre_eps;
    }
}