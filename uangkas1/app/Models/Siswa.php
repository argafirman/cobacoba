<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kelas',
        'no_absen',
        'nomor_induk',
        'saldo',
    ];


    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }


}
