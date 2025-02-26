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
        Schema::create('pengurangansaldo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uangkas_id')->constrained('uangkas')->onDelete('cascade');
            $table->decimal('jumlah', 10, 2);
            $table->string('keterangan')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurangansaldo');
    }
};
