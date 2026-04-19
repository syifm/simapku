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
            $table->string('email', 70)->nullable();
            $table->string('deskripsi');
            $table->string('foto');
            $table->double('latitude')->unique();
            $table->double('longitude')->unique();
            $table->integer('harga_min');
            $table->integer('harga_max');
            $table->double('penilaian');
            $table->string('email_pengaju', 70);
            $table->unsignedInteger('id_wisatawan')->nullable();
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawan')->onDelete('cascade');
            $table->unsignedInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->string('status', 28);
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
