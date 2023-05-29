<?php

namespace App\Http\Controllers\Guest;

use Auth;
use Session;
use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\Station;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function pembayaran(Request $request){
        $this->validate($request, [
            'total' => 'numeric',
            'method' => 'numeric',
        ]);

        $id_user = Auth::user()->id;
        Transaksi::create([
            'invoice' => 0,
            'id_users' => $id_user,
            'total' => $request->total,
            'rating' => 0,
            'metode' => $request->method,
        ]);

        $cart = Session::get('cart');
        $id_transaksi = Transaksi::orderby('id_transaksi', 'desc')->first()->id_transaksi;

        $invoice          = Transaksi::find($id_transaksi);
        $invoice->invoice = "TRANS/".date("Y")."/".date("M")."/00".$id_transaksi;
        $invoice->save();

        foreach($cart as $item =>$val){
            $id_items = $val['id_items'];
            $jumlah = $val['jumlah'];
            $waktu_items = $val['waktu_items'];

            $burst = $waktu_items * $jumlah;
            

            Detail_transaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_items'     => $id_items,
                'jumlah'       => $jumlah,
            ]);
            
        }
        $waktu = explode(':', date('H:i:m'));
        $jam = $waktu[0];
        $menit = $waktu[1];
        $detik = $waktu[2];

        // $waktu_tiba = explode(':', date('H:i:m'));
        $waktu_tiba = explode(':', date('H:i:m'));
        $waktu_tiba_jam = $waktu_tiba[0];
        $waktu_tiba_menit = $waktu_tiba[1];
        $waktu_tiba_detik = $waktu_tiba[2];
        $waktu_start = 0;
        // $burst = 0;
        // $waktu_start = 0 + $burst_final;
        if ($waktu_start = null) {
             $waktu_start = now();
        }else{
             $waktu_start_mulai = $waktu_start + $burst;
        }
        $waiting_time = $waktu_start-$waktu_tiba[1];

        // $menit = explode(':', date('H:i:m'));
        $waktu_tiba = $menit;//awal jika tidak ada pelanggan / transaksi pertama
        $waktu_tiba_pertama = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi', '=', 'antrian.id_detail_transaksi')
                            ->select('antrian.waktu_tiba')
                            // ->where('id_antrian', '=', 1)
                            ->get();
        $waktu_tiba_pertama_ex = explode(':', date('H:i:m'));
        $waktu_tiba_fix = $waktu_tiba_pertama_ex[1];
        // return $waktu_tiba_pertama;

        if ($waktu_tiba_pertama == null) {
            return $waktu_tiba_fix;
            if ($waktu_tiba_pertama != null) {
                return $waktu_tiba;
            }
        }
        $start_time = $menit;
        $burst_time = $waktu_items*$jumlah;
        $start_time2 = $start_time + $burst_time; 
        $finish_menit = $burst_time + $start_time2;

        $waktu_selesai = 0;
        $sisa_waktu_pertama = 0;
        $sisa_waktu_kedua = 0;
        $sisa_waktu = 0;
        if ($finish_menit > 60) {
            $sisa_waktu_pertama = $finish_menit - 60;
            $sisa_waktu = $sisa_waktu_pertama;
            $waktu_selesai = $jam + 1;
            if ($sisa_waktu > 60) {
                $sisa_waktu_kedua = $sisa_waktu_pertama - 60;
                $sisa_waktu = $sisa_waktu_kedua;
                $waktu_selesai = $jam + 2;
            }
                if ($sisa_waktu<10) {
                    $sisa_waktu = '0'.$sisa_waktu;
                }
        }else{
            $waktu_selesai = $jam;
        }
        
        $turn_around_time = $finish_menit - $waktu_tiba;  


        //PAKE CARBON
        // $time = now();
        //waktu_tiba / arrival_time
        // $waktu_tiba = now()->format("d-m-y H:i:s");
        //waktu_mulai / start_time
        // $waktu_mulai= now();
        // $selisih_menit = $waktu_mulai->diffInMinutes($waktu_tiba);
        // $waktu_mulai = $waktu_mulai->subMinute($waktu_tiba)->format("H:i:s");
        //waktu_selesai / finish time
        // $waktu_selesai = Carbon::parse($waktu_selesai);

        // $waktu_selesai2 = 0;
        // if (is_numeric($burst) && is_numeric($selisih_menit)) {
        //     $waktu_selesai2 = $burst + $selisih_menit;
      
        // }
        
        // //waktu_tunggu / waiting time
        // $waktu_tunggu = Carbon::parse($waktu_tiba)->diffInMinutes($waktu_mulai);
        // $tat = Carbon::parse($waktu_tiba)->diffInMinutes($waktu_selesai2);

        
        $id_station = Station::orderby('id_station', 'desc')->first()->id_station;
        
        Antrian::create([
            // 'id_detail_transaksi' =>  $id_transaksi,
            'id_detail_transaksi' =>  $id_transaksi,
            'id_station'          => $id_station,
            'id_users'            => $id_user,
            // 'waktu_tiba'          => $waktu_tiba,
            // 'waktu_tiba'          => $waktu_tiba_pertama,
            'waktu_tiba'          => $jam.':'.$waktu_tiba_fix.':'.$detik,
            'start_time'          => $jam.':'.$start_time.':'.$detik,
            'burst_time'          => $burst,
            'waiting_time'        => $waiting_time,
            'finish_time'         => $finish_menit,
            'tat'                 => $turn_around_time,
        ]);
        // 'start_time' => date('H:i:s'),

        //1 cash 2 cc
        if ($request->method != 1) {
            return $this->cash_payment();
        } else {
            return view('guest.cc_transaksi');
        }
    }

    public function cc_payment(){
        $text = "Pemesanan anda sudah selesai, silahkan menuju kasir atau menunggu waiters kami menghampiri anda";
        Session::forget('cart');
        return view('guest.payment_success', [
            'text' => $text,
        ]);
    }

    public function cash_payment(){
        $text = "Pemesanan anda sudah selesai, silahkan menuju kasir atau menunggu waiters kami menghampiri anda";
        Session::forget('cart');
        return view('guest.payment_success', [
            'text' => $text,
        ]);
    }
}
