<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
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
            // 'waktu_menu' => $request->waktu_menu,
            'metode' => $request->method,
        ]);
        $cart = Session::get('cart');
        $id_transaksi = Transaksi::orderby('id_transaksi', 'desc')->first()->id_transaksi;

        $invoice          = Transaksi::find($id_transaksi);
        $invoice->invoice = "TRANS/".date("Y")."/".date("M")."/00".$id_transaksi;
        $invoice->save();

        // $waktu_menu = 
        // $waktu_pesan =
        // $waktu_antri =
        // $waktu_tiba =
        
        foreach($cart as $item =>$val){
            $id_items = $val['id_items'];
            $jumlah = $val['jumlah'];

            Detail_transaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_items'     => $id_items,
                'jumlah'       => $jumlah,
                'waktu_tiba'  => now(),

            ]);
        }
       
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
