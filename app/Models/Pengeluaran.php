<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';
    protected $fillable = ['tanggal', 'keterangan_pengeluaran', 'jumlah'];
}
