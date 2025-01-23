<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'no_absen' => 'nullable|integer',
            'nomor_induk' => 'required|string|max:20|unique:siswas',
            'saldo' => 'nullable|numeric|min:0',
        ], [
            'nama.required' => 'Nama siswa harus diisi.',
            'kelas.required' => 'Kelas siswa harus diisi.',
            'nomor_induk.required' => 'Nomor induk siswa harus diisi.',
            'saldo.nullable' => 'Saldo siswa tidak boleh kosong.',
        ]);

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'no_absen' => 'nullable|integer',
            'nomor_induk' => 'required|string|max:20|unique:siswas,nomor_induk,' . $siswa->id,
            'saldo' => 'nullable|numeric|min:0',
        ], [
            'nama.required' => 'Nama siswa harus diisi.',
            'kelas.required' => 'Kelas siswa harus diisi.',
            'nomor_induk.required' => 'Nomor induk siswa harus diisi.',
            'saldo.nullable' => 'Saldo siswa tidak boleh kosong.',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->pembayarans()->exists()) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak dapat dihapus karena memiliki data pembayaran.');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

