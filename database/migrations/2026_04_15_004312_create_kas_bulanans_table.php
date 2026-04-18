<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('kas_bulanans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
        $table->string('bulan');
        $table->integer('tahun');

        // Struktur Minggu 1 sampai 4
        for ($i = 1; $i <= 4; $i++) {
            $table->date("tanggal_m_$i")->nullable();
            $table->decimal("jumlah_bayar_m_$i", 10, 2)->default(0);
        }

        $table->text('keterangan')->nullable();
        $table->decimal('total', 10, 2)->default(0);
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('kas_bulanans');
    }
};
