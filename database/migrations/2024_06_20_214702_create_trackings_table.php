<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id('idSeguimiento');
            $table->unsignedBigInteger('derivado_por')->nullable();
            $table->unsignedBigInteger('derivado_a')->nullable();
            $table->dateTime('f_derivacion');
            $table->dateTime('f_recepcion')->nullable();
            $table->dateTime('plazo')->nullable();
            $table->integer('estado');
            $table->integer('tipo'); //Copia derivacion
            $table->string('proveido', 128);
            $table->text('observacion')->nullable();
            $table->unsignedBigInteger('idHruta');
            $table->unsignedBigInteger('idAccion')->nullable();
            $table->foreign('derivado_por')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->foreign('derivado_a')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->foreign('idHruta')->references('idHruta')->on('roadmaps')->onDelete('cascade');
            $table->foreign('idAccion')->references('idAccion')->on('actions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
