<?php

namespace App\Http\Controllers;

use App\Models\KegiatanTahunan;
use Illuminate\Http\Request;

class KegiatanTahunanController extends Controller
{
    public function index()
    {
        $kegiatans = KegiatanTahunan::orderBy('tanggal_kegiatan', 'desc')->get();

        return view('kegiatan_tahunan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('kegiatan_tahunan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'     => 'required',
            'tahun'             => 'required',
            'tanggal_kegiatan'  => 'required',
            'lokasi'            => 'nullable',
            'deskripsi'         => 'nullable',
        ]);

        KegiatanTahunan::create([
            'nama_kegiatan'     => $request->nama_kegiatan,
            'tahun'             => $request->tahun,
            'tanggal_kegiatan'  => $request->tanggal_kegiatan,
            'lokasi'            => $request->lokasi,
            'deskripsi'         => $request->deskripsi,
        ]);

        return redirect()
            ->route('kegiatan_tahunan.index')
            ->with('success', 'Data kegiatan berhasil ditambahkan');
    }

    public function edit(KegiatanTahunan $kegiatanTahunan)
    {
        return view('kegiatan_tahunan.edit', compact('kegiatanTahunan'));
    }

    public function update(Request $request, KegiatanTahunan $kegiatanTahunan)
    {
        $request->validate([
            'nama_kegiatan'     => 'required',
            'tahun'             => 'required',
            'tanggal_kegiatan'  => 'required',
            'lokasi'            => 'nullable',
            'deskripsi'         => 'nullable',
        ]);

        $kegiatanTahunan->update([
            'nama_kegiatan'     => $request->nama_kegiatan,
            'tahun'             => $request->tahun,
            'tanggal_kegiatan'  => $request->tanggal_kegiatan,
            'lokasi'            => $request->lokasi,
            'deskripsi'         => $request->deskripsi,
        ]);

        return redirect()
            ->route('kegiatan_tahunan.index')
            ->with('success', 'Data kegiatan berhasil diupdate');
    }

    public function destroy(KegiatanTahunan $kegiatanTahunan)
    {
        $kegiatanTahunan->delete();

        return redirect()
            ->route('kegiatan_tahunan.index')
            ->with('success', 'Data kegiatan berhasil dihapus');
    }
}
