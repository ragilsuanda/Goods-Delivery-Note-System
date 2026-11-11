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
        Schema::create('suratjalans', function (Blueprint $table) {
            $table->id();
            $table->string('no_suratjalan')->unique();
            $table->enum('status', ['diproses', 'selesai'])->default('diproses');
            $table->date('tanggal_suratjalan');
            $table->string('penerima_barang');
            $table->string('alamat_penerima');
            $table->string('no_kendaraan');
            $table->string('nama_pengemudi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratjalans');
    }
};
