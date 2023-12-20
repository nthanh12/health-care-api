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
        Schema::create('work', function (Blueprint $table) {
            $table->id('idWork');
            $table->bigInteger('idUser')->unsigned();
            $table->string('title');
            $table->datetime('time');
            $table->string('note')->nullable();
            $table->boolean('isCheck')->default(false);
            $table->foreign('idUser')->references('idUser')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work');
    }
};
