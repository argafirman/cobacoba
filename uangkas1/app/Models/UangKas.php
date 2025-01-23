<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangKas extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'uangkas';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'saldo', // Kolom saldo yang akan menyimpan jumlah uang kas
    ];

    // Menambahkan mutator jika ingin memastikan saldo selalu dalam format angka
    protected $casts = [
        'saldo' => 'decimal:2', // Menjaga saldo tetap dalam format desimal dengan 2 angka di belakang koma
    ];
}
