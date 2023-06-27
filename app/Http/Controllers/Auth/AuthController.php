<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;

class AuthController extends Controller
{
    public function index(){
        return view ('auth.login');
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('room', 'password'))){
            return redirect(Auth::user()->level.'/dashboard');
        }elseif (Auth::attempt($request->only('room'.'m001', 'password'.'m001'))){    
            return redirect(Auth::user()->level.'/dashboard/1');
        }
        return redirect('/')->withErrors(['Kode tidak sesuai silahkan coba kembali']);
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
