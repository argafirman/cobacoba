<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenguranganSaldo extends Model
{
    use HasFactory;

    protected $table = 'pengurangansaldo';
    protected $fillable = ['uangkas_id', 'jumlah', 'keterangan'];

    protected static function booted()
    {
        static::creating(function ($penguranganSaldo) {
            $uangKas = $penguranganSaldo->uangkas;
            if ($uangKas->saldo >= $penguranganSaldo->jumlah) {
                $uangKas->saldo -= $penguranganSaldo->jumlah;
                $uangKas->save();
            } else {
                throw new \Exception('Saldo tidak mencukupi untuk pengeluaran ini.');
            }
        });
    }

    public function uangkas()
    {
        return $this->belongsTo(UangKas::class, 'uangkas_id');
    }
}
