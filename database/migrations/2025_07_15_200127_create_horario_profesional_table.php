<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horario_profesional', function (Blueprint $table) {
            $table->id();

            
            $table->unsignedBigInteger('profesional_id');

       
            $table->unsignedBigInteger('horario_id');

   
            $table->foreign('profesional_id')->references('id_profesional')->on('profesionales')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');

            $table->timestamps();

        
            $table->unique(['profesional_id', 'horario_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horario_profesional');
    }
};