<?php

namespace App\Http\Controllers\Guest;

use Auth;
use Session;
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

            $burst = $waktu_items*$jumlah;
            

            Detail_transaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_items'     => $id_items,
                'jumlah'       => $jumlah,
            ]);
            
        }
        // $waktu = 
        $jam = date('H');
        $menit = explode(':', date('H:i:m'));
        $menits = $menit[1];
        $detik = date('s');

        $burst_final = $menits+$burst;
        $burst_final_makanan = $menits+$burst;
        $burst_final_minuman = $menits+$burst;
        $waktu_tiba = explode(':', date('H:i:m'));
        $waktu_start = 0 + $burst_final;
        $waiting_time = $waktu_start-$waktu_tiba[1];

        // $menit = explode(':', date('H:i:m'));
        $waktu_tiba = $menits;//awal jika tidak ada pelanggan / transaksi pertama
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
        $start_time = $menits;
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

        // $waktu_tiba = 0;
        // $start_time = 


        // $tipe = $request->input('tipe');
        // if($tipe == 1){
        //     Antrian::create([
        //         'id_detail_transaksi' =>  $id_transaksi,
        //         'id_station' => 1,
        //         'id_users' => $id_user,
        //         'waktu_tiba' => date('H:i:s'),
        //         'start_time' => date('H:i:s'),
        //         'burst_time' => $jam.':'.$burst_final_makanan.':'.$detik,
        //         // 'waiting_time' => $jam.':'.$burst_final_makanan.':'.$detik,
        //         // 'tat' => $jam.':'.$burst_final.':'.$detik,
        //     ]);
        // }elseif($tipe == 2){
        //     Antrian::create([
        //         'id_detail_transaksi' =>  $id_transaksi,
        //         'id_station' => 2,
        //         'id_users' => $id_user,
        //         'waktu_tiba' => date('H:i:s'),
        //         'start_time' => date('H:i:s'),
        //         'burst_time' => $jam.':'.$burst_final_minuman.':'.$detik,
        //         // 'tat' => $jam.':'.$burst_final.':'.$detik,
        //         // 'waiting_time' => $jam.':'.$burst_final.':'.$detik,
        //     ]);
        // }
        // $data = $tipe->unique('tipe', 1);
        $id_station = Station::orderby('id_station', 'desc')->first()->id_station;
        
        Antrian::create([
            // 'id_detail_transaksi' =>  $id_transaksi,
            'id_detail_transaksi' =>  $id_transaksi,
            'id_station'          => $id_station,
            'id_users'            => $id_user,
            'waktu_tiba'          => $jam.':'.$waktu_tiba_fix.':'.$detik,
            // 'waktu_tiba'          => $waktu_tiba_pertama,
            'start_time'          => $start_time2,
            'burst_time'          => $burst_final,
            'waiting_time'        => $waiting_time,
            'finish_time'         => $waktu_selesai.':'.$sisa_waktu,
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
