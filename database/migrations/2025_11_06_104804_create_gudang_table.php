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
        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gudang');
            $table->string('lokasi');          // alamat atau kota
            $table->integer('kapasitas_kg');   // kapasitas total
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            
            // status gudang untuk katalog
            $table->enum('status_sewa', ['tersedia', 'tidak_tersedia'])
                ->default('tersedia');

            // status operasional gudang (opsional, untuk admin)
            $table->enum('status_operasional', ['aktif', 'nonaktif'])
                ->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudang');
    }
};
