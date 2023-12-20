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
        Schema::create('like', function (Blueprint $table) {
            $table->id('idLike');
            $table->bigInteger('idUser')->unsigned();
            $table->bigInteger('idPost')->unsigned()->nullable();
            $table->bigInteger('idMedicine')->unsigned()->nullable();
            $table->foreign('idUser')->references('idUser')->on('user')
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
        Schema::dropIfExists('like');
    }
};
