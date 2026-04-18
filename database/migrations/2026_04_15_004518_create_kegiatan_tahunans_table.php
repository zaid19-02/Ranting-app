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
        // Saya sarankan pakai nama jamak 'kegiatan_tahunans' agar standar Laravel
        Schema::create('kegiatan_tahunans', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->text('januari')->nullable();
            $table->text('februari')->nullable();
            $table->text('maret')->nullable();
            $table->text('april')->nullable();
            $table->text('mei')->nullable();
            $table->text('juni')->nullable();
            $table->text('juli')->nullable();
            $table->text('agustus')->nullable();
            $table->text('september')->nullable();
            $table->text('oktober')->nullable();
            $table->text('november')->nullable();
            $table->text('desember')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nama di sini HARUS SAMA dengan nama di atas
        Schema::dropIfExists('kegiatan_tahunans');
    }
};
