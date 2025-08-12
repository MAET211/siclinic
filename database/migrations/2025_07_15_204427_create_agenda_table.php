<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();

            $table->date('fecha');                      // Fecha de la cita
            $table->time('hora');                       // Hora exacta de la cita

            $table->unsignedBigInteger('profesional_id');   // FK a profesionales.id_profesional
            $table->unsignedBigInteger('especialidad_id');  // FK a especialidades.id_especialidad
            $table->unsignedBigInteger('id_paciente');      // FK a pacientes.id_paciente
            $table->unsignedBigInteger('cups_id');          // FK a cups.id
            $table->unsignedBigInteger('consultorio_id')->nullable(); // FK a consultorios.id
            $table->unsignedBigInteger('horario_id');       // FK a horarios.id

            $table->string('estado')->default('pendiente'); // pendiente, atendida, cancelada
            $table->text('observaciones')->nullable();      // Notas

            // Relaciones
            $table->foreign('profesional_id')
                  ->references('id_profesional')->on('profesionales')
                  ->onDelete('cascade');

            $table->foreign('especialidad_id')
                  ->references('id_especialidad')->on('especialidades')
                  ->onDelete('cascade');

            $table->foreign('id_paciente')
                  ->references('id_paciente')->on('pacientes')
                  ->onDelete('cascade');

            $table->foreign('cups_id')
                  ->references('id')->on('cups')
                  ->onDelete('cascade');

            $table->foreign('consultorio_id')
                  ->references('id')->on('consultorios')
                  ->onDelete('set null');

            $table->foreign('horario_id')
                  ->references('id')->on('horarios')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
