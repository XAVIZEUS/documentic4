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
        Schema::create('roadmaps', function (Blueprint $table) {
            $table->id('idHruta');
            $table->unsignedBigInteger('idUsuario'); // originado_por
            $table->string('codigo', 60)->nullable();  //creo que es para el cite
            $table->dateTime('f_creacion'); //posiblemente a quitar
            $table->tinyInteger('tipo'); // interno o externo
            $table->tinyInteger('estado');
            $table->text('referencia');
            $table->string('remitente', 100);
            $table->string('cargo_remitente', 50)->nullable();
            $table->string('instituto_remitente', 100)->nullable();
            $table->string('idOficina')->nullable(); //posibleente a quitar
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->foreign('idOficina')->references('idOficina')->on('offices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadmaps');
    }
};
