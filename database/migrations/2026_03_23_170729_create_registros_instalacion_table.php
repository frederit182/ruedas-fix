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
        Schema::create('registros_instalacion', function (Blueprint $table) {
            $table->id();
            $table->string('empresa');
            $table->string('serial_equipo');
            $table->integer('cantidad_ruedas');
            $table->date('fecha_instalacion');

            $table->boolean('tipo_cobro'); // 1 = SI, 0 = NO

            $table->string('numero_factura')->nullable();
            $table->date('fecha_ultima_instalacion')->nullable();

            $table->text('observacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_instalacion');
    }
};
