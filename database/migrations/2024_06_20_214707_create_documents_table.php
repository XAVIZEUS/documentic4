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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('idDocumento');
            $table->unsignedBigInteger('idSeguimiento')->nullable();
            $table->string('nombre', 100);
            $table->dateTime('f_creacion');
            $table->string('url_ruta', 100)->nullable();
            $table->foreign('idSeguimiento')->references('idSeguimiento')->on('trackings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
