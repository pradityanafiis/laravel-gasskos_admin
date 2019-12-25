<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use App\Penginapan;
use App\FotoPenginapan;

class FotoPenginapanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->path = public_path('foto_penginapan');
    }
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        foreach ($request->foto as $foto) {
            $namaFoto = $request->id_penginapan . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move($this->path, $namaFoto);
            FotoPenginapan::create(['id_penginapan' => $request->id_penginapan, 'path' => $namaFoto]);
        }
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $foto = FotoPenginapan::findOrFail($id);
        File::delete($this->path . '\\' . $foto->path);
        FotoPenginapan::where('id_foto', $id)->delete();
        return back();
    }
}
