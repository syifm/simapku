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
        Schema::create('kategori_wisata_kuliner', function (Blueprint $table) {
            $table->unsignedInteger('id_wisata_kuliner');
            $table->foreign('id_wisata_kuliner')->references('id_wisata_kuliner')->on('wisata_kuliner')->onDelete('cascade');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');

            $table->primary(['id_wisata_kuliner', 'id_kategori']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_wisata_kuliner');
    }
};
