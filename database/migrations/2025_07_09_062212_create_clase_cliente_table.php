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
       Schema::create('clase_cliente', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('cliente_id');
    $table->unsignedBigInteger('clase_id');
    $table->timestamps();

    $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('clase_id')->references('id')->on('clases')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_cliente');
    }
};
