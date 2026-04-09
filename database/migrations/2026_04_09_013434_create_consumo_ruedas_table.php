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
       Schema::create('consumo_ruedas', function (Blueprint $table) {
    $table->id();
    $table->date('fecha');
    $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
    $table->string('equipo');
    $table->string('referencia_rueda');
    $table->integer('cantidad');
    $table->boolean('cobro');
    $table->string('numero_documento')->nullable();
    $table->text('observacion')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumo_ruedas');
    }
};
