<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyewa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kontrakkan()
    {
        return $this->belongsToMany(Kontrakkan::class, );
    }

}
