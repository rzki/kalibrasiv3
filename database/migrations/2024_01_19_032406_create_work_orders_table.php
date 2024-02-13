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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices', 'id', 'wo_device_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('wo_type');
            $table->date('wo_date');
            $table->string('wo_category');
            $table->string('wo_complaint');
            $table->date('wo_routine_period_start')->nullable();
            $table->date('wo_routine_period_end')->nullable();
            $table->date('wo_onetime_period_date')->nullable();
            $table->string('wo_approval_status')->nullable();
            $table->text('wo_approval_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
