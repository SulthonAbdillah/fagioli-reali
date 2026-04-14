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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Nama produk
            $table->string('name');

            // Deskripsi produk
            $table->text('description')->nullable();

            // Harga (gunakan integer biar aman, misalnya 15000)
            $table->integer('price');

            // Gambar produk (path file)
            $table->string('image')->nullable();

            // Stok barang
            $table->integer('stock')->default(0);

            // Status produk (aktif / tidak)
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};