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
        Schema::create('post', function (Blueprint $table) {
            $table->id('idPost');
            $table->bigInteger('idUser')->unsigned();
            $table->string('title');
            $table->text('img');
            $table->text('content');
            $table->integer('like')->unsigned()->default(0);
            $table->float('rating')->unsigned();
            $table->foreign('idUser')->references('idUser')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
