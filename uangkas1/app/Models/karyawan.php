<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
