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
       Schema::create('profesional_especialidad', function (Blueprint $table) {
    $table->unsignedBigInteger('id_profesional');
    $table->unsignedBigInteger('id_especialidad');

    $table->foreign('id_profesional')->references('id_profesional')->on('profesionales')->onDelete('cascade');
    $table->foreign('id_especialidad')->references('id_especialidad')->on('especialidades')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesional_especialidad');
    }
};
