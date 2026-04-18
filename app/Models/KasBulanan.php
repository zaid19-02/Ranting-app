<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasBulanan extends Model
{
    protected $table = 'kas_bulanans';
    protected $fillable = [
        'anggota_id', 'bulan', 'tahun',
        'tanggal_m_1', 'jumlah_bayar_m_1',
        'tanggal_m_2', 'jumlah_bayar_m_2',
        'tanggal_m_3', 'jumlah_bayar_m_3',
        'tanggal_m_4', 'jumlah_bayar_m_4',
        'keterangan', 'total'
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
