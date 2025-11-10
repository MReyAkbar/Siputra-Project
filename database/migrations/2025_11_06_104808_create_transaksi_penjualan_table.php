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
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->unsignedBigInteger('gudang_id'); // stok dari gudang mana
            $table->unsignedBigInteger('admin_id');  // yang input transaksi
            $table->timestamps();
            
            $table->foreign('gudang_id')->references('id')->on('gudang')->onDelete('restrict');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualan');
    }
};
