<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Kamar;
use Auth;

class KamarController extends Controller
{
    public function byPenginapan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penginapan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $data = Kamar::where('id_penginapan', $request->id_penginapan)->get();
        return response()->json($data, 200);
    }

    public function byID(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kamar' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $data = Kamar::findOrFail($request->id_kamar);
        return response()->json($data, 200);
    }
}
