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
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('dia_semana', 10);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('lugares_ocupados')->default(0); 
            $table->bigInteger("id_usuario");
            $table->integer('lugares_disponibles')->nullable(); 


            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');

            

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};