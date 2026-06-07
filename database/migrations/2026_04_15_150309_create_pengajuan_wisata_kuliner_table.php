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
        Schema::create('pengajuan_wisata_kuliner', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->unsignedInteger('id_wisata_kuliner')->nullable();
            $table->foreign('id_wisata_kuliner')->references('id_wisata_kuliner')->on('wisata_kuliner')->onDelete('cascade');
            $table->string('nama');
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            $table->string('alamat');
            $table->string('no_telp', 15)->nullable();
            $table->string('deskripsi');
            $table->string('foto')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->enum('sertifikat_halal', ['Sudah', 'Belum'])->default('Belum');
            $table->unsignedInteger('id_wisatawan');
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawan')->onDelete('cascade');
            $table->unsignedInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->enum('status', ['Belum Diverifikasi', 'Disetujui', 'Ditolak'])->default('Belum Diverifikasi');
            $table->enum('status_operasional', ['Aktif', 'Tutup Sementara', 'Tutup Permanen'])->default('Aktif');
            $table->enum('jenis_pengajuan', ['Baru', 'Perubahan']);
            $table->timestamp('waktu_dibuat');
            $table->timestamp('waktu_diubah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_wisata_kuliner');
    }
};
