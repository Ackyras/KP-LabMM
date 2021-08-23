<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsprakPresensiStoreRequest;
use App\Models\Asprak;
use App\Models\QrCode;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RequestStack;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['msg' => 'Login Gagal', 'status' => false, 'error' => 'Akun tidak terdaftar', 'user' => null]);
        }

        $user = auth()->user();
        return response()->json(['msg' => 'Login Berhasil', 'status' => true, 'error' => null, 'user' => $user]);
    }

    public function presensi(AsprakPresensiStoreRequest $req)
    {
        $today = today();
        $now = now();
        $qr = QrCode::where('token', '=', $req->token)->first();
        $asprak = Asprak::find($req->id);
        // return response()->json($qr->valid_until);
        // dd($qr);
        if (!$qr) {
            return response()->json(['msg'  =>  'Presensi gagal', 'status' => false, 'error' => 'QRCode tidak valid'], 404);
        } else {
            if ($qr->valid_until < $now) {
                return response()->json(['msg'  =>  'Presensi gagal', 'status' => false, 'error' => 'QRCode sudah expired'], 406);
                // } else if(){

            } else {
                DB::beginTransaction();
                try {
                    //code...
                    $asprak->presensi()->syncWithoutDetaching(
                        $qr,
                        [
                            'created_at'    =>  $now,
                            'updated_at'    =>  $now,
                        ]
                    );
                    DB::commit();
                } catch (\Throwable $th) {
                    //throw $th;
                    DB::rollback();
                    return response()->json(['msg'  =>  'Presensi gagal', 'status'  =>  false, 'error'  =>  'Terjadi kesalahan pada server, harap menunggu beberapa saat lagi'], 500);
                }
                return response()->json(['msg'  =>  'Presensi berhasil', 'status' => true, 'error' => 'null'], 200);
            }
        }
    }

    public function update(Request $request)
    {
        $error = 'Email telah digunakan';

        $email = User::where('id', $request->id)->where('email', $request->email)->first();

        if ($email) {
            User::where('id', $request->id)->update(
                [
                    'nama'      => $request->nama,
                    'email'     => $request->email,
                    'kelas'     => $request->kelas
                ]
            );
            $error = null;
            if ($request->password != '') {
                User::where('id', $request->id)->update(
                    [
                        'password'      => bcrypt($request->password),
                    ]
                );
            }
        }

        $response = array('error' => $error);

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
    }

    public function isAdmin(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $role = 0;

        if ($user->role == '1') {
            $role = 1;
        }

        $response = array('role' => $role);

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        User::where('id', $request->id)->delete();

        return response()->json("Sukses", 200);
    }

    public function userList()
    {
        $user = User::all();
        return response($user);
    }

    // public function
}
