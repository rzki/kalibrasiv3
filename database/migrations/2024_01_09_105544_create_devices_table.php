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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            // $table->string('barcode');
            // $table->string('name');
            // $table->string('type');
            // $table->string('manufacturer');
            // $table->foreignId('device_category_id')->constrained('device_categories', 'id', 'device_category_id')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreignId('device_location_id')->constrained('device_locations', 'id', 'device_location_id')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->string('condition');
            // $table->string('risk_level');
            // $table->string('vendor');
            // $table->string('status');
            // $table->string('image');
            $table->string('name');
            $table->foreignId('brand_id')->constrained('device_brands', 'id', 'brand_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->constrained('device_types', 'id', 'type_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('serial_number');
            $table->date('calibration_date');
            $table->date('next_calibration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
