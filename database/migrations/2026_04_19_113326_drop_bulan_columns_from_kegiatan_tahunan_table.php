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
        Schema::table('kegiatan_tahunan', function (Blueprint $table) {
            $table->date('tanggal_kegiatan')->after('nama_kegiatan');
            $table->string('lokasi')->nullable()->after('tanggal_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_tahunan', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_kegiatan',
                'lokasi',
            ]);
        });
    }
};
