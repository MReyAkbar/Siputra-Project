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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_penjualan_id');
            $table->unsignedBigInteger('ikan_id');
            $table->integer('jumlah');     // jumlah dijual (kg)
            $table->integer('harga_jual'); // harga per kg saat transaksi
            $table->integer('subtotal');   // total harga (jumlah * harga_jual)

            $table->timestamps();

            $table->foreign('transaksi_penjualan_id')->references('id')->on('transaksi_penjualan')->onDelete('cascade');
            $table->foreign('ikan_id')->references('id')->on('ikan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
