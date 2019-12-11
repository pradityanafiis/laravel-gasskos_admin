<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use App\Penginapan;
use App\Kamar;
use App\MasterFasilitas;
use App\Fasilitas;
use App\FotoPenginapan;

class PenginapanController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->path = public_path('foto_penginapan');
    }
    
    public function index()
    {
        $penginapan = Penginapan::where('id_users', Auth::id())->get();
        return view('penginapan.penginapan', ['penginapan' => $penginapan]);
    }

    public function showTambah()
    {
        $masterfasilitas = MasterFasilitas::all();
        return view('penginapan.tambah_penginapan', ['masterfasilitas' => $masterfasilitas]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:35',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'telepon' => 'required|numeric|digits_between:10,13',
            'foto' => 'required',
            'fasilitas' => 'required'            
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
        
        //INSERT FASILITAS (LOOP)
        foreach ($request->fasilitas as $fasilitas) {
            Fasilitas::create(['id_penginapan' => $lastIdPenginapan, 'id_fasilitas' => $fasilitas]);
        }
        
        //INSERT FOTO (LOOP)
        foreach ($request->foto as $foto) {
            $namaFoto = $lastIdPenginapan . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move($this->path, $namaFoto);
            FotoPenginapan::create(['id_penginapan' => $lastIdPenginapan, 'path' => $namaFoto]);
        }

        Session::flash('success', "Penginapan telah ditambahkan.");
        return redirect('/penginapan/lihat');
    }

    public function delete($id_penginapan)
    {
        Kamar::where('id_penginapan', $id_penginapan)->delete();
        Fasilitas::where('id_penginapan', $id_penginapan)->delete();
        $foto = FotoPenginapan::where('id_penginapan', $id_penginapan)->get();
        if ($foto != null) {
            foreach ($foto as $data) {
                File::delete($this->path . '\\' . $data['path']);
            }
            FotoPenginapan::where('id_penginapan', $id_penginapan)->delete();
        }
        Penginapan::where('id_penginapan', $id_penginapan)->delete();
        Session::flash('success', "Penginapan dan kamar telah dihapus.");
        return redirect('/penginapan/lihat');
    }

    public function showUbah($id_penginapan)
    {
        $data = ([
            'penginapan' => Penginapan::find($id_penginapan),
            'fasilitas' => Fasilitas::where('id_penginapan', $id_penginapan)->get(),
            'masterfasilitas' => MasterFasilitas::all()
        ]);        
        return view('penginapan.ubah_penginapan', $data);
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
        
        Penginapan::where('id_penginapan', $id_penginapan)->update($data);
        Fasilitas::where('id_penginapan', $id_penginapan)->delete();
        foreach ($request->fasilitas as $fasilitas) {
            Fasilitas::create(['id_penginapan' => $id_penginapan, 'id_fasilitas' => $fasilitas]);
        }
        Session::flash('success','Penginapan telah diubah.');
        return redirect('/penginapan/lihat');
    }
}
