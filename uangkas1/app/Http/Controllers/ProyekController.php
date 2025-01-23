<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Proyek;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');
        $pro = Proyek::with('tim.anggota')->withcount('tim')
            ->whereHas('tim', function ($query) use ($cari) {
                if ($cari) {
                    $query->where('nama_tim', 'like', "%$cari%");
                }
            })->get();


        // dd($p->toArray());

        return view('proyek', compact('pro'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required',

        ]);

        Proyek::create([
            'nama_proyek' => $request->nama_proyek,
        ]);
        return redirect()->route('proyek')->with('succes');
    }
}
