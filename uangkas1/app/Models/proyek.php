<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyek extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tim()
    {
        return $this->hasMany(Tim::class);
    }
}
