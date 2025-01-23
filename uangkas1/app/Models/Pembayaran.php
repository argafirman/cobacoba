<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'pembayarans';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = ['siswa_id', 'tanggal', 'jumlah', 'no_absen'];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id'); // Pembayaran milik Siswa
    }

    // Fungsi untuk update saldo uang kas saat pembayaran dibuat
    public static function updateSaldoUangKas($jumlah)
    {
        $uangKas = UangKas::first(); // Mengambil saldo uang kas pertama (anggap ada satu entri)
        if ($uangKas) {
            $uangKas->saldo += $jumlah;
            $uangKas->save();
        }
    }
}
