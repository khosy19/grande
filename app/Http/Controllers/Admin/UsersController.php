<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        $data = User::where('level', 'admin')
                        ->orwhere('level', 'kasir')
                        ->orwhere('level', 'produksi')->get();

        return view('admin.user_list',[
            'data' => $data,
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'  => 'required|max:255|alpha',
            'email' => 'required|max:100|email',
            'password'  => 'required|confirmed',
            'level' => 'required',
            // 'link'  => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'room' => $request->email,
            'level' => $request->level,
            'password' => bcrypt($request->password),
            // 'link'  => 'required',
            'active' => 1,
            'remember_token' => Str::random(60),
        ]);

        $request->session()->flash('info', 'Account Add Successfully');
        return redirect('/admin/management/user');
    }

    public function edit($id){
        $users = User::find($id);
        return view('admin.user_edit', [
            'data' => $users
        ]);
    }

    public function update($id, Request $request){
        if($request->password != ''){
            $this->validate($request, [
                'name'  => 'required',
                'email' => 'required|max:100|email',
                'password'  => 'required|confirmed',
                'password_confirmation' => 'required|same:password',
                'active' => 'required',
            ]);

            $data           = User::find($id);
            $data->name     = $request->name;
            $data->room     = $request->email;
            $data->level    = 'admin';
            $data->password = bcrypt($request->password);
            $data->active   = $request->active;
            $data->save();

            $request->session()->flash('info', 'Account Edit Successfully');
            return redirect('/admin/management/user');

        }else {
            $this->validate($request, [
                'name'  => 'required',
                'email' => 'required|max:100|email',
            ]);

            $data           = User::find($id);
            $data->name     = $request->name;
            $data->room     = $request->email;
            $data->active   = $request->active;
            $data->level    = 'admin';
            $data->save();

            $request->session()->flash('info', 'Acocunt Edit Successfully');
            return redirect('/admin/management/user');
        }
    }

    public function delete($id){
        $users = User::find($id);
        $users->delete();

        return redirect('/admin/management/user')->with([
            'success' => 'Account Delete Successfully'
        ]);
    }

}
