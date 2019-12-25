<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Penginapan;
use Auth;

class PenginapanController extends Controller
{
    public function index()
    {
        $data = Penginapan::all();
        return response()->json($data, 200);
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
        $validator = Validator::make($request->all(), [
            'id_penginapan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $data = Penginapan::findOrFail($request->id_penginapan);
        return response()->json($data, 200);
    }
}
