<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $req)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $req->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $auth = Auth::user();
            if ($auth->role != "calonasprak") {
                return redirect()->route('admin.dashboard');
            } else {
                abort(403);
            }
        }
        abort(403);
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        Auth::logout();
        return redirect()->route('home');
    }
}
