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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('idCliente');
            $table->string('nombre',256);
            $table->string('cargo',50)->nullable();
            $table->string('institucion',64)->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('ciudad',50)->nullable();
            $table->string('direccion',128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
