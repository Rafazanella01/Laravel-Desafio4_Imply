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
    Schema::create('livros', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('titulo');
        $table->string('autor');
        $table->date('data_lancamento');
        $table->enum('genero', ['Romance', 'Clássico', 'Ficção', 'Mistério', 'Ação', 'Drama']);
        $table->integer('numero_paginas');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
