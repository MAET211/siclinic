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
        Schema::create('cups', function (Blueprint $table) {
            $table->id(); // Ahora es 'id' (no 'id_cups')
            $table->string('anio');
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->boolean('habilitado');
            $table->string('usocodigoCUP');
            $table->string('qx');
            $table->string('dxRequerido');
            $table->string('sexo');
            $table->string('estancia');
            $table->decimal('honorario', 10, 2);
            $table->decimal('transporte', 10, 2);
            $table->string('tipo_servicio');
            $table->string('ambito');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cups');
    }
};
