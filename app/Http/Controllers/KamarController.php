<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Auth;
use Session;
use App\Penginapan;
use App\Kamar;
use DB;

class KamarController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
    }
    
    public function index()
    {        
        $kamar = DB::table('kamar')->join('penginapan', 'kamar.id_penginapan', '=', 'penginapan.id_penginapan')->join('users', 'penginapan.id_users', '=', 'users.id')->where('users.id', Auth::id())->get();
        return view('kamar.kamar', ['kamar' => $kamar]);
    }

    public function showTambah()
    {
        $penginapan = Penginapan::where('id_users', Auth::id())->get();
        return view('kamar.tambah_kamar', ['penginapan' => $penginapan]);  
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'penginapan' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|numeric'
        ]);

        $data = array(
            'id_penginapan' => $request->penginapan,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas
        );

        Kamar::create($data);
        Session::flash('success','Kamar telah ditambahkan.');
        return redirect('/kamar/lihat');
    }

    public function delete($id_kamar)
    {
        Kamar::where('id_kamar', $id_kamar)->delete();
        Session::flash('success','Kamar telah dihapus.');
        return redirect('/kamar/lihat');
    }

    public function showUbah($id_kamar)
    {        
        $penginapan = Penginapan::where('id_users', Auth::id())->get();
        $kamar = Kamar::find($id_kamar);
        return view('kamar.ubah_kamar', ['kamar' => $kamar, 'penginapan' => $penginapan]);
    }

    public function update($id_kamar, Request $request)
    {
        $this->validate($request, [
            'penginapan' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',
            'fasilitas' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $data = array(
            'id_penginapan' => $request->penginapan,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'fasilitas' => $request->fasilitas,
            'kapasitas' => $request->kapasitas,
            'id_kamar' => $id_kamar
        );

        $kamar = Kamar::where('id_kamar', $id_kamar)->update($data);
        Session::flash('success','Kamar telah diubah.');
        return redirect('/kamar/lihat');
    }
}
