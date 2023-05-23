<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $antrian_belum_bayar = Transaksi::where('status', 2)->count();
        $antrian_belum = Transaksi::where('status', 0)->count();
        $antrian_sudah = Transaksi::where('status', 1)->count();
        $trans = $antrian_belum +$antrian_sudah;

        return view('kasir.dashboard',[
            'trans' => $trans,
            'status'=> $antrian_belum,
            'status2'=> $antrian_sudah,
            'status3'=> $antrian_belum_bayar,
        ]);
    }
}
