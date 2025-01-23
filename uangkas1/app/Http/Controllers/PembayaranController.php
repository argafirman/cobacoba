<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran; // Import model Pembayaran
use App\Models\Siswa;      // Import model Siswa untuk relasi
use App\Models\UangKas;    // Import model UangKas untuk mengelola saldo uang kas
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('siswa')->get(); // Relasi ke model Siswa
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $siswas = Siswa::all(); // Ambil semua data siswa
        return view('pembayaran.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'no_absen' => 'nullable|integer',
        ], [
            'siswa_id.required' => 'Silakan pilih siswa.',
            'tanggal.required' => 'Tanggal pembayaran tidak boleh kosong.',
            'jumlah.required' => 'Jumlah pembayaran tidak boleh kosong.',
            'jumlah.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'jumlah.min' => 'Jumlah pembayaran minimal 1.',
        ]);

        // Simpan data pembayaran
        Pembayaran::create($validatedData);

        // Temukan siswa yang melakukan pembayaran
        $siswa = Siswa::findOrFail($request->siswa_id);

        // Periksa apakah saldo siswa cukup untuk jumlah pembayaran
        if ($siswa->saldo < 0 && $siswa->saldo + $request->jumlah < 0) {
            return redirect()->back()->withErrors(['message' => 'Saldo siswa tidak cukup untuk pembayaran']);
        }

        // Kurangi saldo siswa dan simpan pembaruan saldo
        $siswa->saldo += $request->jumlah; // Pembayaran akan menambah saldo
        $siswa->save();

        // Periksa apakah pembayaran sudah ada sebelumnya
        $existingPembayaran = Pembayaran::where('siswa_id', $siswa->id)
            ->where('tanggal', $request->tanggal)
            ->first();

        // Jika pembayaran sudah ada, perbarui jumlahnya
        if ($existingPembayaran) {
            $existingPembayaran->jumlah += $request->jumlah; // Tambahkan jumlah pembayaran baru
            $existingPembayaran->save();
            // Update saldo uang kas
            $this->updateUangKas($request->jumlah);
            return redirect()->route('uang_kas.index')->with('success', 'Pembayaran berhasil diperbarui');
        }

        // Jika pembayaran belum ada, simpan data pembayaran baru
        Pembayaran::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'no_absen' => $siswa->no_absen, // Ambil no_absen dari siswa yang dipilih
        ]);

        // Update saldo uang kas
        $this->updateUangKas($request->jumlah);

        return redirect()->route('uang_kas.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $siswas = Siswa::all(); // Ambil semua data siswa
        return view('pembayaran.edit', compact('pembayaran', 'siswas'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        // Temukan siswa terkait dengan pembayaran
        $siswa = Siswa::findOrFail($pembayaran->siswa_id);

        // Mengembalikan saldo siswa ke saldo sebelumnya (jumlah pembayaran sebelumnya)
        $siswa->saldo += $pembayaran->jumlah;

        // Periksa apakah saldo siswa cukup untuk jumlah pembayaran baru
        if ($siswa->saldo + $request->jumlah < 0) {
            return redirect()->back()->withErrors(['message' => 'Saldo siswa tidak cukup untuk pembaruan']);
        }

        // Kurangi saldo sesuai dengan jumlah pembayaran baru
        $siswa->saldo -= $request->jumlah;

        // Simpan saldo yang sudah diperbarui
        $siswa->save();

        // Update data pembayaran
        $pembayaran->update([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'no_absen' => $siswa->no_absen, // Update no_absen dari siswa yang dipilih
        ]);

        // Update saldo uang kas setelah pembaruan pembayaran
        $this->updateUangKas($request->jumlah);

        return redirect()->route('uang_kas.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    // public function destroy(Pembayaran $pembayaran)
    // {
    //     // Ambil jumlah pembayaran yang dihapus
    //     $jumlahPembayaran = $pembayaran->jumlah;

    //     // Hapus pembayaran
    //     $pembayaran->delete();

    //     // Update saldo uang kas setelah pembayaran dihapus
    //     $this->updateUangKas(-$jumlahPembayaran);

    //     return redirect()->route('uang_kas.index')->with('success', 'Pembayaran berhasil dihapus');
    // }

    /**
     * Menambahkan atau mengurangi saldo uang kas
     */
    private function updateUangKas($jumlah)
    {
        // Ambil saldo uang kas pertama (asumsi hanya ada satu entri)
        $uangKas = UangKas::first();

        if (!$uangKas) {
            // Jika tidak ada entri uang kas, buat entri baru
            UangKas::create(['saldo' => $jumlah]);
        } else {
            // Jika ada entri, tambahkan atau kurangi jumlah pembayaran
            $uangKas->saldo += $jumlah;
            $uangKas->save();
        }
    }
}
