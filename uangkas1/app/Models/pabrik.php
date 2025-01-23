<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pabrik extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->hasMany(Cabang::class);
    }
}
