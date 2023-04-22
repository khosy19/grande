<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;

class TransaksiController extends Controller
{
    public function index(){
        $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                    ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')    
                    ->get();
        $unik = $data->unique('id_transaksi');

        return view('admin.transaksi',[
            'data' => $unik,
        ]);
    }

    public function detail($id){
        $detail = Detail_transaksi::join('items', 'items.id_items' , '=', 'detail_transaksi.id_items')
                  ->where('detail_transaksi.id_transaksi', '=', $id)
                  ->get();
                  
        return view('admin.transaksi_detail', [
            'detail' => $detail,
        ]);
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'finish'  => 'numeric|max:1',
        ]);

        $data = Transaksi::find($id);
        $data->status    = $request->finish;
        $data->save();

        $request->session()->flash('info', 'Items Finish');
        return redirect('/admin/management/transaksi');
    }
}
