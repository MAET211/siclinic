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
       Schema::create('profesionales', function (Blueprint $table) {
    $table->id('id_profesional');
    $table->string('nombre', 100);
    $table->string('documento', 20);
    $table->string('telefono', 20);
    $table->string('correo', 100);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales');
    }
};
