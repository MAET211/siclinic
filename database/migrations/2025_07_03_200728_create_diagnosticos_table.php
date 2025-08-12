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
         Schema::create('diagnosticos', function (Blueprint $table) {
        $table->id();
        $table->string('tabla', 50)->nullable();
        $table->string('codigo', 20)->nullable();
        $table->string('nombre', 255)->nullable();
        $table->text('descripcion')->nullable();
        $table->string('habilitado', 10)->nullable();
        $table->string('aplicacion', 10)->nullable();
        $table->boolean('IsStandardGEL')->nullable();
        $table->boolean('IsStandardMSPS')->nullable();
        $table->integer('edad_minima')->nullable();
        $table->integer('edad_maxima')->nullable();
        $table->string('grupo_mortalidad', 10)->nullable();
        $table->string('extra_v', 255)->nullable();
        $table->string('extra_vi_capitulo', 10)->nullable();
        $table->string('extra_vii_grupo', 10)->nullable();
        $table->string('extra_viii_subgrupo', 10)->nullable();
        $table->string('extra_ix_categoria', 10)->nullable();
        $table->string('extra_x_rubro', 10)->nullable();
        $table->string('valorregistro', 10)->nullable();
        $table->string('usuarioregistro', 100)->nullable();
        $table->timestamp('fecha_actualizacion')->nullable();
        $table->string('publicarweb', 10)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
