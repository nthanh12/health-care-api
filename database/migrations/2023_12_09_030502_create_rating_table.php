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
        Schema::create('rating', function (Blueprint $table) {
            $table->id('idRating');
            $table->bigInteger('idUser')->unsigned();
            $table->bigInteger('idDoctor')->unsigned()->nullable();
            $table->bigInteger('idPost')->unsigned()->nullable();
            $table->bigInteger('idMedicine')->unsigned()->nullable();
            $table->integer('rating')->unsigned();
            $table->foreign('idUser')->references('idUser')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idDoctor')->references('idDoctor')->on('doctor')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idPost')->references('idPost')->on('post')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idMedicine')->references('idMedicine')->on('medicine')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
