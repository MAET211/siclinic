<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'fecha',
        'hora',
        'profesional_id',
        'especialidad_id',
        'id_paciente',
        'cups_id',
        'consultorio_id',
        'horario_id',
        'estado',
        'observaciones',
    ];


    // Estas son relaciones directas a otras tablas usando claves foráneas.
    

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'profesional_id', 'id_profesional');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id', 'id_especialidad');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    public function cups()
    {
        return $this->belongsTo(Cups::class, 'cups_id');
    }

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }



    // Relación entre Profesional y Especialidad (tabla intermedia)
    public function profesionalEspecialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'profesional_especialidad', 'profesional_id', 'id_especialidad');
    }

    // Relación entre CUPS y Especialidad (tabla intermedia)
    public function especialidadCups()
    {
        return $this->belongsToMany(Cups::class, 'cups_especialidad', 'id_especialidad', 'cups_id');
    }

    // Relación entre Horario y Profesional (tabla intermedia)
    public function profesionalHorarios()
    {
        return $this->belongsToMany(Horario::class, 'horario_profesional', 'profesional_id', 'horario_id');
    }
}
