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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesa_id')->constrained('mesas');
            $table->foreignId('camarero_id')->constrained('users');
            $table->enum('estado', ['pendiente', 'en_preparacion', 'listo', 'finalizado']);
            $table->decimal('importe_total', 10, 2)->default(0);
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_preparado')->nullable();
            $table->timestamp('fecha_finalizado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
