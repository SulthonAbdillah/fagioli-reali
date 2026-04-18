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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // relasi user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // info user
            $table->string('user_name');
            $table->string('email');

            // total harga
            $table->decimal('total', 10, 2);

            // simpan cart dalam bentuk JSON
            $table->json('items');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};