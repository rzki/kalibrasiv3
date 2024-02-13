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
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('category');
            $table->foreignId('item_unit_id')->constrained('item_units', 'id', 'item_unit_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('price_decisions')->nullable();
            $table->integer('price');
            $table->integer('stock');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_parts');
    }
};
