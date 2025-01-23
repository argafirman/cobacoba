<?php

namespace App\Http\Controllers;

use App\Models\PenguranganSaldo;
use App\Models\UangKas;
use Illuminate\Http\Request;

class PenguranganSaldoController extends Controller
{
    /**
     * Menampilkan daftar pengurangan saldo.
     */
    public function index()
    {
        $pengurangansaldo = PenguranganSaldo::with('uangkas')->latest()->get();
        return view('pengurangansaldo.index', compact('pengurangansaldo'));
    }

    /**
     * Menampilkan form untuk menambahkan pengurangan saldo.
     */
    public function create()
    {
        $uangkas = UangKas::all(); // Daftar uangkas untuk pilihan
        return view('pengurangansaldo.create', compact('uangkas'));
    }

    /**
     * Menyimpan data pengurangan saldo ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'uangkas_id' => 'required|exists:uangkas,id',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'required|string|max:255', // Menjadikan keterangan wajib diisi
        ], [
            'uangkas_id.required' => 'Silakan pilih Uang Kas.',
            'jumlah.required' => 'Harus diisi.',  // Memperbaiki pesan error
            'jumlah.numeric' => 'Jumlah pengurangan saldo harus berupa angka.',
            'jumlah.min' => 'Jumlah pengurangan saldo minimal 0.01.',
            'keterangan.required' => 'Keterangan harus diisi.', // Pesan error untuk keterangan
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',
        ]);

        try {
            // Proses penyimpanan dengan otomatis memperbarui saldo
            PenguranganSaldo::create($data);
            return redirect()->route('pengurangansaldo.index')->with('success', 'Pengurangan saldo berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Menghapus data pengurangan saldo.
     */
    public function destroy(PenguranganSaldo $pengurangansaldo)
    {
        try {
            $uangKas = $pengurangansaldo->uangkas;
            $uangKas->saldo += $pengurangansaldo->jumlah; // Kembalikan saldo yang sebelumnya dikurangi
            $uangKas->save();

            $pengurangansaldo->delete();
            return redirect()->route('pengurangansaldo.index')->with('success', 'Pengurangan saldo berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

