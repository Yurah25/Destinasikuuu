<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id('id_wisata');
        
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kategori');
        
            $table->string('nama_wisata');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('instagram')->nullable();
            $table->string('notelp')->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wisatas');
    }
};