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
        Schema::create('sale', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->date('data_venda');
            $table->foreignId('id_cliente')->constrained()->onDelete('cascade')->references('id')->on('client');
            $table->foreignId('id_product')->constrained()->onDelete('cascade')->references('id')->on('product');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale');
    }
};
