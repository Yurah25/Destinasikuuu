<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->unsignedBigInteger('id_wisata');
            $table->string('filename');
            $table->timestamps();

            $table->foreign('id_wisata')->references('id_wisata')->on('wisatas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeris');
    }
};