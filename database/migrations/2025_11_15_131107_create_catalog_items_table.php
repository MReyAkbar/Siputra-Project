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
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ikan_id');

            $table->string('gambar')->nullable();
            $table->integer('harga_jual');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('ikan_id')->references('id')->on('ikan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_items');
    }
};
