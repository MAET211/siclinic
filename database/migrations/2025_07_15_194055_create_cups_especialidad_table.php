<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cups_especialidad', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cups_id');
            $table->unsignedBigInteger('especialidad_id');

            // FK: Cups (id)
            $table->foreign('cups_id')->references('id')->on('cups')->onDelete('cascade');

            // FK: Especialidades (id_especialidad)
            $table->foreign('especialidad_id')->references('id_especialidad')->on('especialidades')->onDelete('cascade');

            $table->timestamps();

            $table->unique(['cups_id', 'especialidad_id']); // evita duplicados
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cups_especialidad');
    }
};