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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_pembelian_id');
            $table->unsignedBigInteger('varian_id');  
            $table->integer('jumlah_kirim');   // surat jalan
            $table->integer('jumlah_terima');  // berat hasil timbang (dipakai untuk stok)
            $table->integer('harga_beli');     // harga per kg
            
            $table->timestamps();

            $table->foreign('transaksi_pembelian_id')->references('id')->on('transaksi_pembelian')->onDelete('cascade');
            $table->foreign('varian_id')->references('id')->on('varian_ikan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
