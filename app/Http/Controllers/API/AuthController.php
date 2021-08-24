<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(UserLoginRequest $req)
    {
        $field = $req->validated();
        $user = User::where('email', $field['email'])->first();
        if (!$user || Hash::check($field['password'], $user->password)) {
            return response([
                'msg'       =>  'Akun tidak terdaftar, pastikan kembali kredensil anda!',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return response([
            'msg'       =>  'Log in berhasil!',
            'user'      =>  $user,
            'token'     =>  $token,
        ], 200);
    }

    public function logout(Request $req)
    {
        auth()->user()->tokens()->delete();

        return [
            'msg'   =>  'Logged out',
        ];
    }
}
