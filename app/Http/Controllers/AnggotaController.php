<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $anggotas = Anggota::when($search, function ($query, $search) {
            return $query->where('nama_anggota', 'like', "%{$search}%")
                ->orWhere('kode_wilayah', 'like', "%{$search}%")
                ->orWhere('no_telpon', 'like', "%{$search}%");
        })
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

        // ✅ Simpan anggota
        $anggota = Anggota::create($validated);

        // =========================
        // 🔥 AUTO BUAT USER LOGIN
        // =========================

        // username dasar
        $baseUsername = Str::slug($request->nama_anggota);

        // bikin username unik
        $username = $baseUsername;
        $i = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $i;
            $i++;
        }

        // email unik
        $email = $username . '@ranting.com';

        // password dari tanggal lahir
        $passwordPlain = str_replace('-', '', $request->tanggal_lahir);

        // ❗ CEK DUPLIKAT EMAIL (harusnya sudah aman karena username unik)
        if (User::where('email', $email)->exists()) {
            return back()->with('error', 'User dengan email sudah ada');
        }

        // ✅ buat user
        User::create([
            'name' => $request->nama_anggota,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($passwordPlain),
            'role' => 'user'
        ]);

        return redirect()->route('anggotas.index')
            ->with(
                'success',
                "Anggota berhasil ditambahkan.
Email: $email | Password: $passwordPlain"
            );
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

        $username = Str::slug($anggota->nama_anggota);

        User::where('username', $username)->delete();

        $anggota->delete();

        return redirect()->route('anggotas.index')
            ->with('success', 'Anggota bernama ' . $nama . ' telah dihapus');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
