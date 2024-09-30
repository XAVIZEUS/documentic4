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
        Schema::create('make_documents', function (Blueprint $table) {
            $table->id('cite'); //cite
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idTipo');
            $table->string('nombre', 100);
            $table->string('depto', 25);
            $table->date('fecha')->nullable();
            $table->string('sr', 30)->nullable();
            $table->text('destinatario')->nullable();
            $table->string('cargoDest', 30)->nullable();
            $table->string('referencia', 256)->nullable();
            $table->text('contenido')->nullable();
            $table->string('remitente', 100); //usuario o empresa
            $table->string('cargo', 50)->nullable();
            $table->string('descripcion', 50)->nullable();
            $table->string('mosca', 8)->nullable();
            $table->tinyInteger('estado');
            $table->string('url_ruta', 256)->nullable();
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->foreign('idTipo')->references('idTipo')->on('types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('make_documents');
    }
};
