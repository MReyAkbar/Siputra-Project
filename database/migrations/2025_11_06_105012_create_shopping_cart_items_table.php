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
        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('ikan_id');
            $table->decimal('jumlah', 10, 2); // jumlah dalam kg
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('shopping_carts')->onDelete('cascade');
            $table->foreign('ikan_id')->references('id')->on('ikan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_items');
    }
};
