<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_profesional');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', ['pendiente', 'atendida', 'cancelada']);
            $table->unsignedBigInteger('cup_id'); // <- nuevo nombre
            $table->timestamps();

            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes')->onDelete('cascade');
            $table->foreign('id_profesional')->references('id_profesional')->on('profesionales')->onDelete('cascade');
            $table->foreign('cup_id')->references('id')->on('cups')->onDelete('cascade'); // <- referencia a 'id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
