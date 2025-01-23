<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewa_has_kontrakkans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontrakan_id')->constrained('kontrakkans')->OnDelete('casecade');
            $table->foreignId('penyewa_id')->constrained('penyewas')->OnDelete('casecade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewa_has_kontrakkans');
    }
};
