<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pabrik()
    {
        return $this->belongsTo(Pabrik::class);
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}
