<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Penginapan;
use App\Kamar;
use DB;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = DB::table('kamar')->join('penginapan', 'kamar.id_penginapan', '=', 'penginapan.id_penginapan')->join('users', 'penginapan.id_users', '=', 'users.id')->where('users.id', Auth::id())->get();
        return view('kamar.index_kamar', ['kamar' => $kamar]);
    }

    public function create()
    {
        $penginapan = Penginapan::where('id_users', Auth::id())->get();
        return view('kamar.create_kamar', ['penginapan' => $penginapan]);  
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
        return redirect()->route('kamar.index')->with('status', "Kamar telah ditambahkan");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'penginapan' => Penginapan::where('id_users', Auth::id())->get(),
            'kamar' => Kamar::find($id_kamar)
        ];
        return view('kamar.edit_kamar', $data);
    }

    public function update(Request $request, $id)
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
        return redirect()->route('kamar.index')->with('status', 'Kamar telah diubah');
    }

    public function destroy($id)
    {
        Kamar::where('id_kamar', $id_kamar)->delete();
        return redirect()->route('kamar.index')->with('status', 'Kamar telah dihapus');
    }
}
