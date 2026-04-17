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
        Schema::create('pengajuan_fasilitas_wisata_kuliner', function (Blueprint $table) {
            $table->unsignedInteger('id_pengajuan');
            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_wisata_kuliner')->onDelete('cascade');
            $table->unsignedInteger('id_fasilitas');
            $table->foreign('id_fasilitas')->references('id_fasilitas')->on('fasilitas')->onDelete('cascade');

            $table->primary(['id_pengajuan', 'id_fasilitas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_fasilitas_wisata_kuliner');
    }
};
