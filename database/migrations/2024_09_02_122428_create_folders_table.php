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
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',64);
            $table->unsignedBigInteger('carpeta_padre_id')->nullable();
            $table->unsignedBigInteger('idUsuario');

            $table->foreign('carpeta_padre_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('folders');
    }
};
