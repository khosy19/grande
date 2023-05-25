<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(){
        $id_user = Auth::user()->id;
        $transaksi = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                    ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')    
                    ->where('users.id', '=', $id_user) 
                    ->get(); 
        $unik = $transaksi->unique('id_transaksi');
        // return DB::table('items')->sum('waktu_menu');
        return view('guest.history', [
            'transaksi' => $unik,
        ]);
    }

    public function detail($id){
        // $detail = Detail_transaksi::join('items', 'items.id_items' , '=', 'detail_transaksi.id_items')
        // // ->join('users', 'users.id', '=', 'detail_transaksi.id_users')
        // ->where('detail_transaksi.id_transaksi', '=', $id)
        // ->get();
       
        $antrian_detail = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
        ->leftjoin('station', 'station.id_station', '=', 'antrian.id_station')
        ->leftjoin('users', 'users.id', '=', 'antrian.id_antrian')
        ->leftjoin('items', 'items.id_items', '=', 'detail_transaksi.id_items')
        ->select('antrian.*', 'items.nama_makanan', 'items.waktu_menu', 'detail_transaksi.jumlah')
        ->where('detail_transaksi.id_transaksi', '=', $id)
        ->get();

        return $antrian_detail;
        die();
        // ->get();

        // return $antrian_detail;
        
        // $datetime_waktu_tiba = $antrian_detail->waktu_tiba;
        // $datetime_burst_time = $antrian_detail->burst_time;
        // $datetime_start_time = $antrian_detail->start_time;
        // $datetime_finish_time = $antrian_detail->finish_time;
        // $datetime_array_waktu_tiba = explode(" ", $datetime_waktu_tiba);
        // $datetime_array_burst_time = explode(" ", $datetime_burst_time);
        // $datetime_array_start_time = explode(" ", $datetime_start_time);
        // $datetime_array_finish_time = explode(" ", $datetime_finish_time);

        // // Ambil nilai jam, menit, dan detik dari bagian waktu
        // $time_array_waktu_tiba = explode(":", $datetime_array_waktu_tiba[1]);
        // $time_array_burst_time = explode(":", $datetime_array_burst_time[1]);
        // $time_array_start_time = explode(":", $datetime_array_start_time[1]);
        // $time_array_finish_time = explode(":", $datetime_array_finish_time[1]);
        
        // $hour_waktu_tiba = $time_array_waktu_tiba[0];
        // $minute_waktu_tiba = $time_array_waktu_tiba[1];
        // $second_waktu_tiba = $time_array_waktu_tiba[2];
        
        // $waktu_tunggu = count $waktu_menu;        
        return view('guest.history_detail', [
            'detail' => $antrian_detail,
            // 'tb' => $time_array_waktu_tiba,
            // 'bt' => $time_array_burst_time,
            // 'st' => $time_array_start_time,
            // 'fin' => $time_array_finish_time,
        ], compact('antrian_detail'));
    }

    public function hitungWaktuTunggu($waktuselesai){
        $waktuselesai = Detail_transaksi::join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->where('transaksi.status',1) 
        ->get();
        
    }
}
