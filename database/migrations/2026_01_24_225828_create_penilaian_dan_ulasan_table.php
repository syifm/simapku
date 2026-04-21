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
        Schema::create('penilaian_dan_ulasan', function (Blueprint $table) {
            $table->increments('id_penilaian_dan_ulasan');
            $table->unsignedInteger('id_wisata_kuliner');
            $table->foreign('id_wisata_kuliner')->references('id_wisata_kuliner')->on('wisata_kuliner')->onDelete('cascade');
            $table->unsignedInteger('penilaian');
            $table->string('ulasan');
            $table->string('foto_ulasan')->nullable();
            $table->unsignedInteger('harga_min')->nullable();
            $table->unsignedInteger('harga_max')->nullable();
            $table->string('email_pengulas', 70);
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
        Schema::dropIfExists('penilaian_dan_ulasan');
    }
};
