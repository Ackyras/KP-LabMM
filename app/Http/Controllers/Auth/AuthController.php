<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function proseslogin(Request $req){
        request()->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $credentials = $req->only('username', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->level=='admin'){
                return redirect()->intended('admin');
            }elseif($user->level=='editor'){
                return redirect()->intended('user');
            }
            return redirect('/');
        }
        return redirect('login')->withSucces('Gak bisa bahasa enggress');
    }

    public function logout(Request $req){
        $req->session()->flush;
        Auth::logout();
        return redirect('login');
    }
}

