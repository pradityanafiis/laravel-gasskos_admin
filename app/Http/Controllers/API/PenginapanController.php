<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Penginapan;
use App\Kamar;
use App\FotoPenginapan;
use DB;

class PenginapanController extends Controller
{
    public function index()
    {
        $penginapans = DB::table('penginapan')->take(8)->orderBy('created_at', 'desc')->get();
        $data = collect([]);
        foreach ($penginapans as $penginapan) {
            $foto = FotoPenginapan::where('id_penginapan', $penginapan->id_penginapan)->select('path')->first();
            $temp = [
                'id_penginapan' => $penginapan->id_penginapan,
                'id_users' => $penginapan->id_users,
                'gender' => $penginapan->gender,
                'nama' => $penginapan->nama,
                'alamat' => $penginapan->alamat,
                'latitude' => $penginapan->latitude,
                'longitude' => $penginapan->longitude,
                'telepon' => $penginapan->telepon,
                'foto' => $foto->path
            ];
            $data->push($temp);
        }
        return response()->json(['penginapan' => $data], 200);
    }

    public function byGender(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $data = Penginapan::where('gender', $request->gender)->get();
        return response()->json($data, 200);
    }

    public function byID(Request $request)
    {
        $data = collect([]);
        $penginapan = Penginapan::findOrFail($request->id_penginapan);
        $foto = FotoPenginapan::where('id_penginapan', $penginapan->id_penginapan)->select('path')->first();
        $temp = [
            'id_penginapan' => $penginapan->id_penginapan,
            'id_users' => $penginapan->id_users,
            'gender' => $penginapan->gender,
            'nama' => $penginapan->nama,
            'alamat' => $penginapan->alamat,
            'latitude' => $penginapan->latitude,
            'longitude' => $penginapan->longitude,
            'telepon' => $penginapan->telepon,
            'foto' => $foto->path
        ];
        $data->push($temp);

        return response()->json([
            'penginapan' => $data[0],
            'fasilitas' => DB::table('fasilitas')->join('master_fasilitas', 'fasilitas.id_fasilitas', '=', 'master_fasilitas.id_fasilitas')->where('fasilitas.id_penginapan', $request->id_penginapan)->select('master_fasilitas.nama')->get(),
            'kamar' => Kamar::where('id_penginapan', $request->id_penginapan)->get(),
            'foto' => FotoPenginapan::where('id_penginapan', $request->id_penginapan)->select('path')->get()
        ]);
    }
}
