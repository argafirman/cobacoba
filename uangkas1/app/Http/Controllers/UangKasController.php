<?php

namespace App\Http\Controllers;

use App\Models\UangKas;
use Illuminate\Http\Request;

class UangKasController extends Controller
{
    public function index()
    {
        // Ambil saldo uang kas pertama atau buat data baru jika tidak ada
        $uangKas = UangKas::first();

        // Jika tidak ada data, buat satu baris data baru dengan saldo 0
        if (!$uangKas) {
            $uangKas = UangKas::create(['saldo' => 0]);
        }

        return view('uangkas.index', compact('uangKas'));
    }

    public function update(Request $request)
    {
        // Validasi input saldo
        $request->validate([
            'saldo' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        // Ambil saldo uang kas pertama
        $uangKas = UangKas::first();
        if (!$uangKas) {
            $uangKas = UangKas::create(['saldo' => 0]); // Jika belum ada, buat data baru
        }

        // Update saldo uang kas
        $uangKas->saldo += $request->jumlah; // Tambahkan jumlah pembaruan ke saldo
        $uangKas->save();

        return redirect()->route('uangkas.index')->with('success', 'Saldo Uang Kas berhasil diperbarui');
    }
}
