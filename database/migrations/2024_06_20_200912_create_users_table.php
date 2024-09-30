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
        Schema::create('users', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('idRegion', 10)->nullable();
            $table->string('idOficina', 10)->nullable();
            $table->unsignedBigInteger('idCargo')->nullable();
            $table->string('usuario', 100);
            $table->string('password', 250);
            $table->string('apellidos', 100);
            $table->string('nombres', 100);
            $table->integer('ci')->unique();
            $table->string('correo', 50)->nullable();
            $table->string('mosca', 20)->nullable();
            $table->smallInteger('estado');
            $table->string('celular', 20)->nullable();
            $table->string('url_foto', 100)->nullable();
            $table->foreign('idRegion')->references('idRegion')->on('regions')->onDelete('cascade');
            $table->foreign('idOficina')->references('idOficina')->on('offices')->onDelete('cascade');
            $table->foreign('idCargo')->references('idCargo')->on('works')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
