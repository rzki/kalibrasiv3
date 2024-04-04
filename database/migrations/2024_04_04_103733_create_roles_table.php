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
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('roleId')->primary();
            $table->string('name');
            $table->string('code');
            $table->foreignUuid('user_id')->after('location')->nullable()->constrained('users', 'userId', 'user_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('role_id')->after('location')->nullable()->constrained('roles', 'roleId', 'role_id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
