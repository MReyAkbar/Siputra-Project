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
        Schema::create('stok_gudang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ikan_id');
            $table->unsignedBigInteger('gudang_id');
            $table->integer('jumlah_stok')->default(0);

            // Foreign Keys
            $table->foreign('ikan_id')->references('id')->on('ikan')->onDelete('cascade');
            $table->foreign('gudang_id')->references('id')->on('gudang')->onDelete('cascade');

            // Ensure no duplicate stock row for same gudang+ikan
            $table->unique(['ikan_id', 'gudang_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_gudang');
    }
};
