<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanTahunan extends Model
{
    protected $table = 'kegiatan_tahunan';
    protected $fillable = [
        'tahun', 'januari', 'februari', 'maret', 'april', 'mei', 'juni',
        'juli', 'agustus', 'september', 'oktober', 'november', 'desember'
    ];
}
