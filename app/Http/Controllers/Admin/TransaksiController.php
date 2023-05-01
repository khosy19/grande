<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index(Request $request){
        $status = $request->input('status');
        if ($status == 'unpayment') {
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
                        ->where('status', 2)    
                        ->get();
        }elseif ($status =='waiting') {
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
                        ->where('status', 0)    
                        ->get();
        }elseif($status == 'success'){
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
                        ->where('status', 1)    
                        ->get();
        }else{
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->get(); 
        }
        
        $unik = $data->unique('id_transaksi');
        // return $unik;
        return view('admin.transaksi',[
            'data' => $unik,
            // 'data2' => $data2,
            // 'status' => $status,
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
