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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid');
            $table->string('type');
            $table->string('status');
            $table->foreignId('employee_dept_id')->constrained('employee_depts', 'id', 'employee_dept_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('employee_position_id')->constrained('employee_positions', 'id', 'employee_position_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('email');
            $table->string('phone_number');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
