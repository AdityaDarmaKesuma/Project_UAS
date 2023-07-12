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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string("kode", 20);
            $table->string("nama", 50);
            $table->double("harga_jual");
            $table->double("harga_beli");
            $table->integer("stok");
            $table->integer("min_stok");
            $table->text("deskripsi");
            $table->text("foto_produk")->nullable();
            $table->foreignId('kategori_produk_id')->constrained('kategori_produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
