<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula')->unique();
            $table->enum('estado',['alquilado','devuelto','taller','reparado','esperando piezas',])->default('devuelto');
            $table->boolean('listo_entrega')->default(false);
            $table->boolean('sucio')->default(false);
            $table->boolean('sin_gasolina')->default(false);
            $table->boolean('en_taller')->default(false);
            $table->string('combustible');
            $table->text('observaciones')->nullable();
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
