<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontrakkan;

class KontrakkanController extends Controller
{
    public function index()
    {
        $kontrakkans = Kontrakkan::with('penyewa')->get();

        dd($kontrakkans->toArray());
        return view('kontrakkan', compact('kontrakkans'));
    }
}
