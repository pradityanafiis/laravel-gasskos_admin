<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $tanggal_masuk = new Carbon($request->tanggal_masuk);
        $data = array(
            'id_users' => $request->id_users,
            'id_kamar' => $request->id_kamar,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $tanggal_masuk->addDays($request->durasi),
            'status' => null
        );
        Transaksi::create($data);
        return response()->json(['message' => "Berhasil tambah data"]);
    }
}
