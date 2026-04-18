<?php

namespace App\Http\Controllers;

use App\Models\KasBulanan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class KasBulananController extends Controller
{
    public function index(Request $request)
    {
        $bulan  = $request->query('bulan', 'All');
        $tahun  = $request->query('tahun', date('Y'));
        $search = $request->query('search');

        $bulanList = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        $kasBulanans = Anggota::where('status', '!=', 'GURU RANTING')

            // 🔍 SEARCH NAMA
            ->when($search, function ($query) use ($search) {
                $query->where('nama_anggota', 'like', "%$search%");
            })

            ->with(['kasBulanans' => function ($query) use ($bulan, $tahun) {

                $query->where('tahun', $tahun);

                if (!empty($bulan) && $bulan !== 'All') {
                    $query->where('bulan', $bulan);
                }

            }])

            ->orderBy('nama_anggota', 'asc')
            ->get();

        return view('kas_bulanans.index', compact(
            'kasBulanans',
            'bulan',
            'tahun',
            'bulanList',
            'search'
        ));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', '!=', 'GURU RANTING')
            ->orderBy('nama_anggota', 'asc')
            ->get();

        $bulanList = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        return view('kas_bulanans.create', compact('anggotas', 'bulanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'bulan'      => 'required',
            'tahun'      => 'required',
        ]);

        $m1 = (int) ($request->jumlah_bayar_m_1 ?? 0);
        $m2 = (int) ($request->jumlah_bayar_m_2 ?? 0);
        $m3 = (int) ($request->jumlah_bayar_m_3 ?? 0);
        $m4 = (int) ($request->jumlah_bayar_m_4 ?? 0);

        $total = $m1 + $m2 + $m3 + $m4;

        KasBulanan::updateOrCreate(
            [
                'anggota_id' => $request->anggota_id,
                'bulan'      => $request->bulan,
                'tahun'      => $request->tahun
            ],
            [
                'tanggal_m_1'      => $request->tanggal_m_1,
                'jumlah_bayar_m_1' => $m1,

                'tanggal_m_2'      => $request->tanggal_m_2,
                'jumlah_bayar_m_2' => $m2,

                'tanggal_m_3'      => $request->tanggal_m_3,
                'jumlah_bayar_m_3' => $m3,

                'tanggal_m_4'      => $request->tanggal_m_4,
                'jumlah_bayar_m_4' => $m4,

                'total'      => $total,
                'keterangan' => $request->keterangan ?? '-',
            ]
        );

        return redirect()
            ->route('kas_bulanans.index')
            ->with('success', 'Data Kas Berhasil Disimpan!');
    }

    // ✅ FIX ERROR EDIT
    public function edit($id)
    {
        $kas = KasBulanan::findOrFail($id);

        $anggotas = Anggota::orderBy('nama_anggota')->get();

        $bulanList = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        return view('kas_bulanans.edit', compact('kas', 'anggotas', 'bulanList'));
    }

    // ✅ UPDATE DATA
    public function update(Request $request, $id)
    {
        $kas = KasBulanan::findOrFail($id);

        $m1 = (int) ($request->jumlah_bayar_m_1 ?? 0);
        $m2 = (int) ($request->jumlah_bayar_m_2 ?? 0);
        $m3 = (int) ($request->jumlah_bayar_m_3 ?? 0);
        $m4 = (int) ($request->jumlah_bayar_m_4 ?? 0);

        $kas->update([
            'tanggal_m_1'      => $request->tanggal_m_1,
            'jumlah_bayar_m_1' => $m1,

            'tanggal_m_2'      => $request->tanggal_m_2,
            'jumlah_bayar_m_2' => $m2,

            'tanggal_m_3'      => $request->tanggal_m_3,
            'jumlah_bayar_m_3' => $m3,

            'tanggal_m_4'      => $request->tanggal_m_4,
            'jumlah_bayar_m_4' => $m4,

            'total' => $m1 + $m2 + $m3 + $m4,
            'keterangan' => $request->keterangan ?? '-',
        ]);

        return redirect()
            ->route('kas_bulanans.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $kas = KasBulanan::findOrFail($id);
        $kas->delete();

        return redirect()
            ->back()
            ->with('success', 'Data berhasil dihapus!');
    }
}
