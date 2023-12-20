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
        Schema::create('medicine', function (Blueprint $table) {
            $table->id('idMedicine');
            $table->bigInteger('idDoctor')->unsigned();
            $table->string('nameMedicine');
            $table->text('img');
            $table->float('price')->unsigned();
            $table->text('content');
            $table->integer('like')->unsigned()->default(0);
            $table->float('rating')->unsigned()->default(0);
            $table->foreign('idDoctor')->references('idDoctor')->on('doctor')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine');
    }
};
