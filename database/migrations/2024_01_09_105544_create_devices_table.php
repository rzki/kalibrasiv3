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
            $table->uuid('deviceId');
            $table->string('name')->nullable();
            $table->foreignId('brand_id')->constrained('device_brands', 'id', 'brand_id')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('type_id')->constrained('device_types', 'id', 'type_id')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->string('serial_number')->nullable();
            $table->date('calibration_date')->nullable();
            $table->date('next_calibration_date')->nullable();
            $table->text('barcode');
            $table->timestamps();
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
