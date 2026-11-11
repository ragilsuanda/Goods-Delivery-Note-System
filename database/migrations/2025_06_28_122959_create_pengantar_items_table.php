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
        Schema::create('pengantar_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_jalan_id')->constrained('suratjalans')->onDelete('cascade');
            $table->unsignedBigInteger('databarang_id')->nullable(); // referensi non relasi
            $table->string('nama_barang');
            $table->string('ukuran_barang')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('jumlah_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengantar_items');
    }
};
