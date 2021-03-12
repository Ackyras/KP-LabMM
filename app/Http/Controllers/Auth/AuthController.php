<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login')
    }

    public function proseslogin(Request $req){
        requesr()->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $credentials = $req->only('username', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->level=='admin'){
                return redirect->intended('admin');
            }elseif($user->level=='editor'){
                return redirecy()->intended('user');
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

