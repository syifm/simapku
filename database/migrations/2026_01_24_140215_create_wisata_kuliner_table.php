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
        Schema::create('wisata_kuliner', function (Blueprint $table) {
            $table->increments('id_wisata_kuliner');
            $table->string('nama');
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            $table->string('alamat');
            $table->string('no_telp', 15)->nullable();
            $table->string('deskripsi');
            $table->string('foto')->nullable();
            $table->double('latitude')->unique();
            $table->double('longitude')->unique();
            $table->integer('harga_min')->nullable();
            $table->integer('harga_max')->nullable();
            $table->double('penilaian')->nullable();
            $table->enum('sertifikat_halal', ['Sudah', 'Belum']);
            $table->unsignedInteger('id_wisatawan')->nullable();
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawan')->onDelete('cascade');
            $table->unsignedInteger('id_admin');
            $table->foreign('id_admin');
            $table->enum('status', ['Belum Diverifikasi', 'Disetujui', 'Ditolak'])->default('Belum Diverifikasi');
            $table->enum('status_operasional', ['Aktif', 'Tutup Sementara', 'Tutup Permanen'])->default('Aktif');
            $table->timestamp('waktu_dibuat');
            $table->timestamp('waktu_diubah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata_kuliner');
    }
};
