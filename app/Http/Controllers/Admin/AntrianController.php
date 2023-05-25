<?php

namespace App\Http\Controllers\Admin;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
{
    public function index(Request $request){
        $fcfs = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
        ->join('station', 'station.id_station', '=', 'antrian.id_station')
        ->join('users', 'users.id', '=', 'antrian.id_antrian')
        ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->select('antrian.*', 'station.nama_station', 'transaksi.invoice')
        // ->where('detail_transaksi.id_antrian', '=', $id)
        ->get();
         
        return view('admin.fcfs',[
            'fcfs' => $fcfs,

        ]);

    }
}
