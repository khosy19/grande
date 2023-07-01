<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use URL;

class RoomController extends Controller
{
    public function index(){
        $data = User::wherelevel('guest')->get();

        return view('admin.room_list',[
            'data' => $data,
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => 'required|max:100',
            'password'  => 'required',
            'status'    => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'room' => $request->email,
            'level' => 'guest',
            'link' => URL::to('/auth?room='.$request->email.'&password='.$request->password),
            'active' => $request->status,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        $request->session()->flash('info', 'Room Add Successfully');
        return redirect('/admin/management/room');
    }

    public function edit($id){
        $room = User::find($id);
        return view('admin.room_edit', [
            'data' => $room
        ]);
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|max:100',
            'password'  => 'required',
            'status'  => 'required',
        ]);

        $data           = User::find($id);
        $data->name     = $request->name;
        $data->room     = $request->email;
        $data->level    = 'guest';
        $data->password = bcrypt($request->password);
        $data->active   = $request->status;
        $data->save();

        $request->session()->flash('info', 'Account Edit Successfully');
        return redirect('/admin/management/room');
    }

    public function delete($id){
        $users = User::find($id);
        $users->delete();

        return redirect('/admin/management/room')->with([
            'success' => 'Account Delete Successfully'
        ]);
    }
    public function cetakqr($id){
        $cetakqr = User::find($id);
        // return $cetakStruk;
        // die();
        return view('admin.cetak_qr',[
            'cetakqr' => $cetakqr,
        ]);

    }
}
