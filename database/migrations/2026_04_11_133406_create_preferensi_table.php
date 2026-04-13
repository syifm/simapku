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
        Schema::create('preferensi', function (Blueprint $table) {
            $table->unsignedInteger('id_wisatawan');
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawan')->onDelete('cascade');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->unsignedInteger('jumlah');

            $table->primary(['id_wisatawan', 'id_kategori']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferensi');
    }
};
