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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->increments('id_ulasan');
            $table->unsignedInteger('id_wisata_kuliner');
            $table->foreign('id_wisata_kuliner')->references('id_wisata_kuliner')->on('wisata_kuliner')->onDelete('cascade');
            $table->unsignedInteger('penilaian');
            $table->text('ulasan');
            $table->string('foto_ulasan')->nullable();
            $table->unsignedInteger('harga_min')->nullable();
            $table->unsignedInteger('harga_max')->nullable();
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['Belum Diverifikasi', 'Disetujui', 'Ditolak'])->default('Belum Diverifikasi');
            $table->enum('status_penampilan', ['Tampil', 'Tidak Tampil'])->default('Tidak Tampil');
            $table->timestamp('waktu_dibuat');
            $table->timestamp('waktu_diubah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
