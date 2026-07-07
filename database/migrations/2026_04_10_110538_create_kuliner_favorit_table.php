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
        Schema::create('kuliner_favorit', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_wisata_kuliner');
            $table->foreign('id_wisata_kuliner')->references('id_wisata_kuliner')->on('wisata_kuliner')->onDelete('cascade');
            $table->timestamp('waktu_dibuat');

            $table->primary(['id_user', 'id_wisata_kuliner']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuliner_favorit');
    }
};
