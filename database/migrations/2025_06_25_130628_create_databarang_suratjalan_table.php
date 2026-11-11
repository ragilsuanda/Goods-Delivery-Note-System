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
        Schema::create('databarang_suratjalan', function (Blueprint $table) {
            $table->id();

            // relasi ke suratjalan_id tetap cascade
            $table->foreignId('suratjalan_id')
                ->constrained('suratjalans')
                ->onDelete('cascade');

            // relasi ke databarang_id TIDAK cascade
            $table->unsignedBigInteger('databarang_id')->nullable();
            $table->foreign('databarang_id')
                ->references('id')->on('databarangs')
                ->nullOnDelete(); // NULL jika databarang dihapus

            $table->integer('jumlah_barang');

            // salinan data
            $table->string('nama_barang')->nullable();
            $table->string('ukuran_barang')->nullable();
            $table->string('satuan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('databarang_suratjalan', function (Blueprint $table) {
            $table->dropForeign(['databarang_id']);
            $table->dropForeign(['suratjalan_id']);
        });

        Schema::dropIfExists('databarang_suratjalan');
    }
};
