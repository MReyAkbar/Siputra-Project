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
        Schema::create('ikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama'); // Nama ikan => contoh Layang 20-25, Kembung 10-15, Tuna 2up
            $table->string('kode')->unique(); //contoh: "LAY-20-25", "KMB-10-15", "TNA-2UP"
            $table->integer('harga_beli')->nullable();
            $table->text('deskripsi')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikan');
    }
};
