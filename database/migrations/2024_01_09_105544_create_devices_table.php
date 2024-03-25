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
            $table->foreignId('brand_id')->nullable()->constrained('device_brands', 'id', 'brand_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->nullable()->constrained('device_types', 'id', 'type_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('serial_number')->nullable();
            $table->date('calibration_date')->nullable();
            $table->date('next_calibration_date')->nullable();
            $table->text('barcode');
            
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
