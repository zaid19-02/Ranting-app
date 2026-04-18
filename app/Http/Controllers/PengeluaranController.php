<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal', 'desc')->get();
        return view('pengeluarans.index', compact('pengeluarans'));
    }

    public function create()
    {
        return view('pengeluarans.create');
    }

    public function store(Request $request)
    {
        Pengeluaran::create($request->all());
        return redirect()->route('pengeluarans.index')->with('success', 'Data pengeluaran berhasil ditambahkan');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('pengeluarans.edit', compact('pengeluaran'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->all());
        return redirect()->route('pengeluarans.index')->with('success', 'Data pengeluaran berhasil diupdate');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluarans.index')->with('success', 'Data pengeluaran berhasil dihapus');
    }
}
