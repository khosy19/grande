<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use Session;
use Auth;

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

        $jam = date('H');
        $menit = explode(':', date('H:i:m'));
        $menits = $menit[1];
        $detik = date('s');

        $burst_final = $menits+$burst;

        Antrian::create([
            'id_detail_transaksi' =>  $id_transaksi,
            'id_station' => 1,
            'id_users' => $id_user,
            'waktu_tiba' => date('H:i:s'),
            'start_time' => date('H:i:s'),
            'burst_time' => $jam.':'.$burst_final.':'.$detik,
        ]);

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
