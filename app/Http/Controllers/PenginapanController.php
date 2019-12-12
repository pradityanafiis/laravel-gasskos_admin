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
        return view('penginapan.penginapan', ['penginapan' => Penginapan::where('id_users', Auth::id())->get()]);
    }

    public function create()
    {
        return view('penginapan.tambah_penginapan', ['masterfasilitas' => MasterFasilitas::all()]);
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
        
        //INSERT FASILITAS (LOOP)
        foreach ($request->fasilitas as $fasilitas) {
            Fasilitas::create(['id_penginapan' => $penginapan->id_penginapan, 'id_fasilitas' => $fasilitas]);
        }
        
        //INSERT FOTO (LOOP)
        foreach ($request->foto as $foto) {
            $namaFoto = $penginapan->id_penginapan . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move($this->path, $namaFoto);
            FotoPenginapan::create(['id_penginapan' => $penginapan->id_penginapan, 'path' => $namaFoto]);
        }
        
        return redirect()->route('penginapan.index')->with('status', "Penginapan $penginapan->nama telah ditambahkan");
    }

    public function show($id)
    {
        return view('pengnapan.detail_penginapan', ['penginapan' => Penginapan::where('id_penginapan', $id)->get()]);  
    }

    public function edit($id)
    {
        $data = ([
            'penginapan' => Penginapan::find($id),
            'fasilitas' => Fasilitas::where('id_penginapan', $id)->get(),
            'masterfasilitas' => MasterFasilitas::all()
        ]);        
        return view('penginapan.ubah_penginapan', $data);
    }

    public function update(Request $request, $id)
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
            'id_penginapan' => $id
        );
        
        Penginapan::where('id_penginapan', $id)->update($data);
        Fasilitas::where('id_penginapan', $id)->delete();
        foreach ($request->fasilitas as $fasilitas) {
            Fasilitas::create(['id_penginapan' => $id, 'id_fasilitas' => $fasilitas]);
        }
        return redirect()->route('penginapan.index')->with('status', "Penginapan telah diubah");
    }

    public function destroy($id)
    {
        Kamar::where('id_penginapan', $id)->delete();
        Fasilitas::where('id_penginapan', $id)->delete();
        $foto = FotoPenginapan::where('id_penginapan', $id)->get();
        if ($foto != null) {
            foreach ($foto as $data) {
                File::delete($this->path . '\\' . $data['path']);
            }
            FotoPenginapan::where('id_penginapan', $id)->delete();
        }
        Penginapan::where('id_penginapan', $id)->delete();
        return redirect()->route('penginapan.index')->with('status', "Penginapan dan kamar telah dihapus");
    }
}
