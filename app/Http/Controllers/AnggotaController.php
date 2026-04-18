<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota dengan fitur pencarian dan urutan khusus.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $anggotas = Anggota::when($search, function ($query, $search) {
            return $query->where('nama_anggota', 'like', "%{$search}%")
                         ->orWhere('kode_wilayah', 'like', "%{$search}%")
                         ->orWhere('no_telpon', 'like', "%{$search}%");
        })
        /** * LOGIKA URUTAN:
         * 1. Status 'GURU RANTING' diprioritaskan ke atas (skor 1)
         * 2. Status lainnya di bawahnya (skor 2)
         * 3. Kemudian diurutkan berdasarkan Nama dari A ke Z
         */
        ->orderByRaw("CASE WHEN status = 'GURU RANTING' THEN 1 ELSE 2 END")
        ->orderBy('nama_anggota', 'asc')
        ->get();

        return view('anggotas.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggotas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_wilayah' => 'required',
            'nama_anggota' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat'       => 'required',
            'kelurahan'    => 'required',
            'kecamatan'    => 'required',
            'kabupaten_kota' => 'required',
            'provinsi'     => 'required',
            'ranting'      => 'required',
            'status'       => 'required',
            'no_telpon'    => 'required',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggotas.index')
            ->with('success', 'Data anggota ' . $request->nama_anggota . ' berhasil ditambahkan');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggotas.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'kode_wilayah' => 'required',
            'nama_anggota' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat'       => 'required',
            'kelurahan'    => 'required',
            'kecamatan'    => 'required',
            'kabupaten_kota' => 'required',
            'provinsi'     => 'required',
            'ranting'      => 'required',
            'status'       => 'required',
            'no_telpon'    => 'required',
        ]);

        $anggota->update($validated);

        return redirect()->route('anggotas.index')
            ->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(Anggota $anggota)
    {
        $nama = $anggota->nama_anggota;
        $anggota->delete();

        return redirect()->route('anggotas.index')
            ->with('success', 'Anggota bernama ' . $nama . ' telah dihapus');
    }

    /**
     * Mengarahkan fungsi search ke index agar satu pintu
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }
}
