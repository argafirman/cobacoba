<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pabrik;

class PabrikController extends Controller
{
    public function index()
    {
        $pap = Pabrik::with('cabang.karyawan')->get();
        // dd($pap->toArry());

        return view('pabrik', compact('pap'));
    }
}
