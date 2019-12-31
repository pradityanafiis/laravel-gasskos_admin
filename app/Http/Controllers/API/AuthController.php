<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'true',
                    'message' => 'Email atau password salah'
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'true',
                'message' => 'could_not_create_token'
            ]);
        }

        $user = User::where('email', $request->email)->get()->first();
        return response()->json([
            'error' => 'false',
            'message' => 'Berhasil login',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['User Not Found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['Token Expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['Token Invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['Token Absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
