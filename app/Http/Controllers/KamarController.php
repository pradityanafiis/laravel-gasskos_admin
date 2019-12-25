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
        return view('kamar.create_kamar', ['penginapan' => Penginapan::where('id_users', Auth::id())->get()]);  
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'penginapan' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|numeric',
            'jumlah' => 'required|numeric'
        ]);

        $data = array(
            'id_penginapan' => $request->penginapan,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas,
            'jumlah' => $request->jumlah
        );

        Kamar::create($data);
        return redirect()->route('kamar.index')->with('status', "Kamar telah ditambahkan");
    }

    public function edit($id)
    {
        $data = [
            'penginapan' => Penginapan::where('id_users', Auth::id())->get(),
            'kamar' => Kamar::find($id)
        ];
        return view('kamar.edit_kamar', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'penginapan' => 'required',
            'tipe' => 'required',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|numeric',
            'jumlah' => 'required|numeric'
        ]);

        $data = array(
            'id_penginapan' => $request->penginapan,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'kapasitas' => $request->kapasitas,
            'jumlah' => $request->jumlah
        );

        $kamar = Kamar::where('id_kamar', $id)->update($data);
        return redirect()->route('kamar.index')->with('status', 'Kamar telah diubah');
    }

    public function destroy($id)
    {
        Kamar::where('id_kamar', $id)->delete();
        return redirect()->route('kamar.index')->with('status', 'Kamar telah dihapus');
    }
}
