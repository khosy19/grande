<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Session;

class DetailsController extends Controller
{
    static function details_items($id){
        $items = Items::find($id);
        return view('guest.details', [
            'items' => $items,
        ]);
    }

    static function tambah_transaksi($room,$nama,$total,$waktu_pesan,$waktu_selesai){
        Transaksi::create([
            'room' => $room,
            'nama' => $nama,
            'total'=> $total,
        ]);
    }

    static function tambah_detail_transaksi($nama_items,$harga,$jumlah,$waktu_menu,$waktu_pesan,$waktu_selesai,$waktu_tunggu){
        $waktu_pesan->waktu_pesan = now();
        Items::create([
            'nama_items'    => $nama_items,
            'harga_items'   => $harga,
            'jumlah'        => $jumlah,
            'waktu_menu'    => $waktu_menu,
            'waktu_pesan'   =>$waktu_pesan,
            'waktu_tunggu'  =>$waktu_tunggu,
            'waktu_selesai' =>$waktu_selesai,
        ]);
    }

    public function tambah_cart($id_items, Request $request){
        $this->validate($request,[
            'qty' => 'required|numeric',
            // 'waktu_pesan'   => 'required'
        ]);
        $qty = $request->qty;
        $waktu_pesan = $request->waktu_pesan;
        // $waktu_selesai = $request->waktu_selesai;

        $data = Session::get('cart');
        $items = Items::where('id_items', $id_items)->get();

        $data[$items[0]->id_items] = [
            'id_items'      => $items[0]->id_items,
            'nama_items'    => $items[0]->nama_makanan,
            'harga_items'   => $items[0]->harga,
            'jumlah'        => $qty,
            // 'waktu_pesan'   => $waktu_pesan,
            // 'waktu_pesan'    =>  $waktu_pesan,
            // 'waktu_selesai'    => $waktu_selesai,
        ];

        Session::put('cart', $data);
        return redirect('/guest/dashboard')->with([
            'success' => 'Success add items :)'
        ]);
    }

    public function hapus_cart($id){
        $data = Session::get('cart');
        unset($data[$id]);
        Session::put('cart', $data);
        return redirect()->back()->with([
            'success' => 'Success deleted items :)'
        ]);
    }

    public function cart(){
        $cart = Session::get('cart');
        return view('guest.transaksi', [
            'cart' => $cart,
        ]);
    }
}
