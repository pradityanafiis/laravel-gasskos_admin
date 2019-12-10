<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Penginapan;
use App\Kamar;
use App\MasterFasilitas;
use App\Fasilitas;

class PenginapanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $penginapan = Penginapan::where('id_users', Auth::id())->get();
        return view('penginapan.penginapan', ['penginapan' => $penginapan]);
    }

    public function showTambah()
    {
        $fasilitas = MasterFasilitas::all();
        return view('penginapan.tambah_penginapan', ['fasilitas' => $fasilitas]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:35',
            'alamat' => 'required',
            'telepon' => 'required|numeric|digits_between:10,13'
        ]);

        $data = array(
            'id_users' => Auth::id(),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'telepon' => $request->telepon
        );
        
        $penginapan = Penginapan::create($data);
        $lastIdPenginapan = $penginapan->id_penginapan;
        foreach ($request->fasilitas as $fasilitas) {
            Fasilitas::create(['id_penginapan' => $lastIdPenginapan, 'id_fasilitas' => $fasilitas]);
        }
        Session::flash('success', "Penginapan telah ditambahkan.");
        return redirect('/penginapan/lihat');
    }

    public function delete($id_penginapan)
    {
        Kamar::where('id_penginapan', $id_penginapan)->delete();
        Fasilitas::where('id_penginapan', $id_penginapan)->delete();
        Penginapan::where('id_penginapan', $id_penginapan)->delete();
        Session::flash('success', 'Penginapan dan kamar telah dihapus.');
        return redirect('/penginapan/lihat');
    }

    public function showUbah($id_penginapan)
    {
        $penginapan = Penginapan::find($id_penginapan);
        return view('penginapan.ubah_penginapan', ['penginapan' => $penginapan]);
    }

    public function update($id_penginapan, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:35',
            'alamat' => 'required',
            'telepon' => 'required|numeric|digits_between:10,13'
        ]);

        $data = array(
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'id_penginapan' => $id_penginapan
        );

        $penginapan = Penginapan::where('id_penginapan', $id_penginapan)->update($data);
        Session::flash('success','Penginapan telah diubah.');
        return redirect('/penginapan/lihat');
    }
}
