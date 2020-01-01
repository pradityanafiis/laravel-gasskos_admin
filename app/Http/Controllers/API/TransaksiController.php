<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Transaksi;
use App\Kamar;
use App\Penginapan;
use App\FotoPenginapan;
use DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $data = collect([]);
        $listTransaksi = Transaksi::where('id_users', $request->id_user)->get();
        foreach ($listTransaksi as $transaksi) {
            $kamar = Kamar::where('id_kamar', $transaksi->id_kamar)->first();
            $penginapan = Penginapan::where('id_penginapan', $kamar->id_penginapan)->first();
            $foto = FotoPenginapan::where('id_penginapan', $penginapan->id_penginapan)->select('path')->first();
            $temp = [
                'id_transaksi' => $transaksi->id_transaksi,
                'id_users' => $transaksi->id_users,
                'id_kamar' => $transaksi->id_kamar,
                'tanggal_masuk' => $transaksi->tanggal_masuk,
                'tanggal_keluar' => $transaksi->tanggal_keluar,
                'status' => $transaksi->status,
                'total_harga' => $transaksi->total_harga,
                'rating' => $transaksi->rating,
                'komentar' => $transaksi->komentar,
                'foto' => $foto->path,
                'kamar' => $kamar,
                'penginapan' => $penginapan
            ];
            $data->push($temp);
        }
        return response()->json(['transaksi' => $data]);
    }

    public function byID(Request $request)
    {
        $data = collect([]);
        $transaksi = Transaksi::where('id_transaksi', $request->id_transaksi)->first();
        $kamar = Kamar::where('id_kamar', $transaksi->id_kamar)->first();
        $penginapan = Penginapan::where('id_penginapan', $kamar->id_penginapan)->first();
        $foto = FotoPenginapan::where('id_penginapan', $penginapan->id_penginapan)->select('path')->first();
        $temp = [
            'id_transaksi' => $transaksi->id_transaksi,
            'id_users' => $transaksi->id_users,
            'id_kamar' => $transaksi->id_kamar,
            'tanggal_masuk' => $transaksi->tanggal_masuk,
            'tanggal_keluar' => $transaksi->tanggal_keluar,
            'status' => $transaksi->status,
            'total_harga' => $transaksi->total_harga,
            'rating' => $transaksi->rating,
            'komentar' => $transaksi->komentar,
            'foto' => $foto->path,
            'kamar' => $kamar,
            'penginapan' => $penginapan
        ];
        $data->push($temp);
        return response()->json(['transaksi' => $data[0]]);        
    }

    public function store(Request $request)
    {
        $tanggal_masuk = new Carbon($request->tanggal_masuk);
        $harga = Kamar::where('id_kamar', $request->id_kamar)->select('harga')->first();
        $data = array(
            'id_users' => $request->id_users,
            'id_kamar' => $request->id_kamar,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $tanggal_masuk->addDays($request->durasi),
            'total_harga' => ($request->durasi * $harga->harga),
            'status' => "Aktif",
            'rating' => null,
            'komentar' => null
        );
        Transaksi::create($data);
        return response()->json(['message' => "Berhasil memesan kamar"]);
    }
}
