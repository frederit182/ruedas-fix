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
    Schema::create('inventario_ruedas', function (Blueprint $table) {
        $table->id();
        $table->string('proveedor');
        $table->string('referencia_rueda');
        $table->integer('cantidad');
        $table->date('fecha_compra');
        $table->string('factura')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_ruedas');
    }
};
