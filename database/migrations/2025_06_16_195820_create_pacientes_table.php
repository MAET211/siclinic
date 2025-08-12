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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id_paciente');
            $table->string('nombre', 100);
            $table->string('apellido', 100); // ✅ Campo agregado
            $table->string('documento', 20);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 20);
            $table->string('direccion', 150);
            $table->text('observaciones')->nullable(); // ✅ agregado aquí
            $table->boolean('activo')->default(true);   // ✅ también aquí
            $table->unsignedBigInteger('id_eps');
            $table->timestamps();

            $table->foreign('id_eps')->references('id_eps')->on('eps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
