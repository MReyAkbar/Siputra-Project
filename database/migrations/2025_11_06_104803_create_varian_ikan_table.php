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
        Schema::create('varian_ikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ikan_id');
            $table->string('nama_varian');     // contoh: "15-20", "Baby", "Sedang"
            $table->integer('harga_jual');      // harga per kg untuk varian ini
            $table->timestamps();

            $table->foreign('ikan_id')->references('id')->on('ikan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varian_ikan');
    }
};
