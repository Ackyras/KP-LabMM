<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\Models\Asprak;
use App\Models\Presensi;
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
                'status'    =>  false,
                'msg'       =>  'Akun tidak terdaftar, pastikan kembali kredensil anda!',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $asprak = $user->asprak;
        return response([
            'status'    =>  true,
            'msg'       =>  'Log in berhasil!',
            'user'      =>  $asprak,
            'token'     =>  $token,
        ], 200);
    }

    public function logout(Request $req)
    {
        auth()->user()->tokens()->delete();

        return [
            'status'    =>  true,
            'msg'       =>  'Logged out',
        ];
    }

    public function profile($id)
    {
        $profile = Asprak::with('presensi')->find($id);
        $presensi = $profile->presensi;
        foreach ($presensi as $item) {
            $item->matakuliahs = $item->matakuliah;
        }
        // dd($profile);
        if (!$profile) {
            return response([
                'status'    =>  false,
                'msg'       =>  'Profil anda tidak ditemukan'
            ], 404);
        } else {
            return response([
                'status'    =>  true,
                'msg'       =>  'Profil anda didapatkan',
                'profile'   =>  $profile,
            ]);
        }
    }
}
