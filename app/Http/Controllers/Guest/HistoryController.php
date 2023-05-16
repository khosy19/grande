<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
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
        // return $minute;

       


        // return $pelangganPesan;

        // return view('guest.history_detail',[
        //     'pelangganPesan' => $historyDetail,
        // ]);



        $waktu_menu = $detail[0]["waktu_menu"];
        // $waktu_tunggu = count $waktu_menu;        
        return view('guest.history_detail', [
            'detail' => $detail,
            // 'pelanggan_pesan' => $pelangganPesan,
            // 'waktu_pesan' => $waktu,
        ]);
    }

    public function hitungWaktuTunggu($waktuselesai){
        $waktuselesai = Detail_transaksi::join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_detail_transaksi')
        ->where('transaksi.status',1) 
        ->get();
        $n = count($waktuselesai);
        
        $wt = array_fill(0, $n, 0); // inisialisasi array wt dengan nol

        // hitung lama waktu tunggu
        for ($i = 1; $i < $n; $i++) {
            $wt[$i] = $waktuselesai[$i-1]->waktu_menu + $wt[$i-1] - $waktuselesai[$i]->waktu_tunggu;
        }

        // kembalikan array wt
        return $wt;
    }
}
