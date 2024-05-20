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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->uuid('logId');
            $table->foreignId('inventory_id')->nullable()->constrained('inventories', 'id', 'inventory_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal_mulai_pinjam');
            $table->date('tanggal_selesai_pinjam');
            $table->string('lokasi_pinjam');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook');
    }
};
