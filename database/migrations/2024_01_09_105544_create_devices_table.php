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
            $table->foreignId('name_id')->nullable()->constrained('device_names', 'id', 'name_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('brand')->nullable();
            $table->string('type')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals', 'id', 'hospital_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('calibration_date')->nullable();
            $table->date('next_calibration_date')->nullable();
            $table->text('barcode')->nullable();
            $table->string('status')->nullable();
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
