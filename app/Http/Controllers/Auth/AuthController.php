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
        $credentials = $request->only('room', 'password');
    
        // Check if the request includes a login URL
        if ($request->filled('room') && $request->filled('password')) {
            $credentials['room'] = $request->input('room');
            $credentials['password'] = $request->input('password');
        }
    
        if(Auth::attempt($credentials)){
            return redirect(Auth::user()->level.'/dashboard');
        }
    
        return redirect('/')->withErrors(['Kode tidak sesuai silahkan coba kembali']);
    }
    

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
