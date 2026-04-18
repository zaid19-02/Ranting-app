<?php

namespace App\Http\Controllers;

use App\Models\KegiatanTahunan;
use Illuminate\Http\Request;

class KegiatanTahunanController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanTahunan::orderBy('tahun', 'desc')->first();
        return view('kegiatan_tahunan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('kegiatan_tahunan.create');
    }

    public function store(Request $request)
    {
        KegiatanTahunan::create($request->all());
        return redirect()->route('kegiatan_tahunan.index')->with('success', 'Data kegiatan tahunan berhasil ditambahkan');
    }

    public function edit(KegiatanTahunan $kegiatanTahunan)
    {
        return view('kegiatan_tahunan.edit', compact('kegiatanTahunan'));
    }

    public function update(Request $request, KegiatanTahunan $kegiatanTahunan)
    {
        $kegiatanTahunan->update($request->all());
        return redirect()->route('kegiatan_tahunan.index')->with('success', 'Data kegiatan tahunan berhasil diupdate');
    }

    public function destroy(KegiatanTahunan $kegiatanTahunan)
    {
        $kegiatanTahunan->delete();
        return redirect()->route('kegiatan_tahunan.index')->with('success', 'Data kegiatan tahunan berhasil dihapus');
    }
}
