<?php

namespace App\Http\Controllers\Admin;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
{
    public function index(Request $request){
        $tipe = $request->input('tipe');

        if ($tipe == 'makanan') {
            $fcfs = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
            ->join('station', 'station.id_station', '=', 'antrian.id_station')
            ->join('users', 'users.id', '=', 'antrian.id_antrian')
            ->join('items', 'items.id_items', '=', 'detail_transaksi.id_items')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->select('antrian.*', 'station.nama_station', 'transaksi.invoice')
            ->where('items.tipe', '=', 1)
            ->get();
        }elseif($tipe == 'minuman'){
            $fcfs = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
            ->join('station', 'station.id_station', '=', 'antrian.id_station')
            ->join('users', 'users.id', '=', 'antrian.id_antrian')
            ->join('items', 'items.id_items', '=', 'detail_transaksi.id_items')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->select('antrian.*', 'station.nama_station', 'transaksi.invoice')
            ->where('items.tipe', '=', 2)
            ->get(); 
        }else{
            $fcfs = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
            ->join('station', 'station.id_station', '=', 'antrian.id_station')
            ->join('users', 'users.id', '=', 'antrian.id_antrian')
            ->join('items', 'items.id_items', '=', 'detail_transaksi.id_items')
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->select('antrian.*', 'station.nama_station', 'transaksi.invoice')
            // ->where('items.tipe', '=', 2)
            ->get();   
        }  
        return view('admin.fcfs',[
            'tipe' => $fcfs,
            // 'fcfs_minuman' => $fcfs_minuman,

        ]);

    }
}
