<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->onDelete('cascade');
            $table->string('periode'); // e.g., '2025-06'
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('tunjangan')->default(0);
            $table->bigInteger('potongan')->default(0);
            $table->bigInteger('total_gaji');
            $table->date('tanggal_input');
            $table->string('api_token');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};