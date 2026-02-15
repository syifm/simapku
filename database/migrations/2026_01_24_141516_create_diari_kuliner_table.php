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
        Schema::create('diari_kuliner', function (Blueprint $table) {
            $table->increments('id_diari_kuliner');
            $table->unsignedInteger('id_wisatawan');
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawan')->onDelete('cascade');
            $table->string('judul', 100);
            $table->string('deskripsi');
            $table->string('foto');
            $table->string('waktu_dibuat');
            $table->string('waktu_diubah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diari_kuliner');
    }
};
