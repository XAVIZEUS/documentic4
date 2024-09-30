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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',64);
            $table->text('descripcion')->nullable();  //cambiar a URL
            $table->unsignedBigInteger('carpeta_padre_id');
            $table->unsignedBigInteger('idusuario')->nullable();

            $table->foreign('carpeta_padre_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
