<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
{
    public function index(Request $request){
        $data = $request->input('waktu_masuk');
        $data2 = $request->input('waktu_keluar');
        $antrian = Antrian::join('users', 'users.id', '=', 'antrian.id_users')
        ->join('transaksi', 'transaksi.id_transaksi', '=', 'antrian.id_transaksi')
        ->get(); 
         
        // return view('admin.transaksi',[
        //     'waktu_masuk' => $data,
        //     'waktu_keluar' => $data2,
        //     'antrian' => $antrian,

        // ]);

    }
    public function update($id, Request $request){
        $this->validate($request, [
            'finish'  => 'numeric|max:1',
        ]);

        $data = Antrian::find($id);
        $data->status    = $request->finish;
        $data->save();
        Alert::success('Success Title', 'Success Message');
        $request->session()->flash('info', 'Status A Berhasil Diubah');
        return redirect('/admin/management/transaksi');
    }
}
