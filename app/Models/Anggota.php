<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    protected $table = 'anggotas';
    protected $fillable = [
        'kode_wilayah', 'nama_anggota', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'kelurahan', 'kecamatan', 'kabupaten_kota',
        'provinsi', 'ranting', 'status', 'no_telpon'
    ];

    public function kasBulanans(): HasMany
    {
        return $this->hasMany(KasBulanan::class, 'anggota_id');
    }
}
