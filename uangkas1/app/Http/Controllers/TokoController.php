<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
class TokoController extends Controller
{
    public function index(Request $request)
    {

        $cari = $request->query('cari');
        $T = Toko::with('barang')->withcount('barang')->where('status', 'buka')
            ->whereHas('barang', function ($query) use ($cari) {
                if ($cari) {
                    $query->where('nama_barang', 'like', "%$cari%");
                }
            })->get();

        // dd($T->toArray());

        return view('barang', compact('T'));

    }


    // public function store(Request $request)
    // {

    //     // $request->validate([
    //     //     'nama_toko' => 'required',
    //     // ])

    // }


}

//  public function index(Request $request)
//     {
//         $cari = $request->query('cari');
//         $So = Showroom::with('kendaraan')
//             ->whereHas('kendaraan', function ($query) use ($cari) {
//                 if ($cari) {
//                     $query->where('nama_kendaraan', 'like', "%$cari%");
//                 }
//             })->get();
//         return view('showroom.index', compact('So'));
//     }


