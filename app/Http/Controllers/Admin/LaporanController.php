<?php

namespace App\Http\Controllers\Admin;

use App\Models\Antrian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    public function index(){
        return view('admin.laporan');
        }
    public function cetak_laporan_penjualan(){
        $laporan_penjualan = Detail_transaksi::join('transaksi', 'transaksi.id_transaksi' , '=', 'detail_transaksi.id_transaksi')
        ->leftjoin('items', 'items.id_items', '=', 'detail_transaksi.id_items')
        ->select('transaksi.invoice', 'transaksi.total', 'items.nama_makanan', 'items.harga', 'detail_transaksi.jumlah')
        // ->where('transaksi.status', '=', 1)
        // ->where('detail_transaksi.id_transaksi')
        // ->groupBy('items.nama_makanan', 'transaksi.total', 'items.harga', 'detail_transaksi.jumlah')
        ->get();

        return view('admin.cetak_laporan_penjualan',[
            'laporan_penjualan' => $laporan_penjualan,
        ]);
    }
    public function cetak_menu_favorit(){
        //eksperimen 2
        $menu_favorit = Detail_transaksi::join('items', 'items.id_items', '=', 'detail_transaksi.id_items')
        ->select('items.nama_makanan', 'items.harga', DB::raw('COUNT(detail_transaksi.jumlah) as jumlah_total_transaksi') ,DB::raw('SUM(detail_transaksi.jumlah) as total_sum'))
        ->groupBy('items.nama_makanan', 'items.harga')
        ->orderBy('id_detail_transaksi', 'desc')
        ->get();
        //ekseperimen 1
        // $menu_favorit = Detail_transaksi::join('transaksi', 'transaksi.id_transaksi' , '=', 'detail_transaksi.id_transaksi')
        // ->join('items', 'items.id_items', '=', 'detail_transaksi.id_items')
        // ->select('items.nama_makanan', DB::raw('COUNT(detail_transaksi.id_transaksi) as jumlah'))
        // // ->orderBy('detail_transaksi.jumlah', 'desc')
        // ->groupBy('items.nama_makanan')
        // ->orderByDesc('jumlah')
        // ->get();


        // Eksperimen 3
        // $menu_favorit = DB::table('items')
        //         ->selectRaw('count(id_items) as nama_makanan, waktu_menu')
        //         ->groupBy('waktu_menu')
        //         // ->havingBetween('number_of_orders', [5, 15])
        //         ->orderByDesc('waktu_menu')
        //         ->get();

        // return $menu_favorit;

        // $hitung_menu_favorit = $menu_favorit->count();
        // return $menu_favorit;

        // $menu_favorit = request('jumlah')->jumlah;

        return view('admin.cetak_menu_favorit',[
            'menu_favorit'  => $menu_favorit,
        ]);
    }
    public function cetak_laporan_fcfs(){
        $laporan_fcfs =Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
        ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->select('antrian.*','transaksi.invoice')
        ->get();  
        return view('admin.cetak_laporan_fcfs',[
            'laporan_fcfs'  => $laporan_fcfs,
        ]); 
    }
}
