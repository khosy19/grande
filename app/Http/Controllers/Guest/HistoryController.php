<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $id_user = Auth::user()->id;
        $transaksi = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                    ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')    
                    ->where('users.id', '=', $id_user) 
                    ->get(); 
        $unik = $transaksi->unique('id_transaksi');
        return view('guest.history', [
            'transaksi' => $unik,
        ]);
    }

    public function detail($id){
        $detail = Detail_transaksi::join('items', 'items.id_items' , '=', 'detail_transaksi.id_items')
        // ->join('users', 'users.id', '=', 'detail_transaksi.id_users')
        ->where('detail_transaksi.id_transaksi', '=', $id)
        ->get();

        // return $detail;
        $datetime = $detail[0]["waktu_pesan"]; // contoh datetime dari database
        $datetime_array = explode(" ", $datetime);

        // Ambil nilai jam, menit, dan detik dari bagian waktu
        $time_array = explode(":", $datetime_array[1]);
        $hour = $time_array[0];
        $minute = $time_array[1]+5;
        $second = $time_array[2];
        // return $minute.':'.$second;
        // Cetak jam, menit, dan detik yang telah diambil
        // echo "Jam: " . $hour . "<br>";
        // echo "Menit: " . $minute . "<br>";
        // echo "Detik: " . $second . "<br>";
                  
        return view('guest.history_detail', [
            'detail' => $detail,
            // 'waktu_pesan' => $waktu,
        ]);
    }
}
