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
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Rol_id')->nullable();
            $table->unsignedBigInteger('Usuario_id')->nullable();
            
            $table->foreign('Rol_id')->references('idRol')->on('roles')->onDelete('cascade');
            $table->foreign('Usuario_id')->references('idUsuario')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
