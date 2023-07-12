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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->string("nama_pemesan", 50);
            $table->text("alamat_pemesan");
            $table->string("no_hp", 30);
            $table->string("email", 50);
            $table->integer("jumlah_pesanan");
            $table->text("deskripsi");
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
