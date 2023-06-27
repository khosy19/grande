<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class TransaksiController extends Controller
{
    public function index(Request $request){
        $status = $request->input('status');
        if ($status =='waiting') {
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
                        ->where('status', 0)    
                        ->get();
        }elseif($status == 'success'){
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
                        ->where('status', 1)    
                        ->get();
        }else{
            $data = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->where('status', 2)
            ->get(); 
        }
        
        $unik = $data->unique('id_transaksi');
        // return $unik;
        return view('kasir.transaksi',[
            'data' => $unik,
            // 'data2' => $data2,
            // 'status' => $status,
        ]);

    }

    public function detail($id){
        $detail = Detail_transaksi::join('items', 'items.id_items' , '=', 'detail_transaksi.id_items')
                // ->join('users', 'users.id', '=', 'detail_transaksi.id_users')
                ->where('detail_transaksi.id_transaksi', '=', $id)
                ->get();
        $detail2 = Detail_transaksi::all();
        
                  
        return view('kasir.transaksi_detail', [
            'detail' => $detail,
        ]);
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'finish'  => 'numeric|max:1',
        ]);

        $data = Transaksi::find($id);
        $data->status    = $request->finish;
        $data->save();
        // Alert::success('Success Title', 'Success Message');
        // $request->session()->flash('info', 'Status Transaksi Berhasil Diubah');
        return redirect()->route('transaksi_kasir')->with('toast_success', 'Data Berhasil Divalidasi');
    }
    public function cetak_struk(Request $request){
        $cetak_struk = Antrian::join('detail_transaksi', 'detail_transaksi.id_detail_transaksi' , '=', 'antrian.id_detail_transaksi')
        // ->leftjoin('station', 'station.id_station', '=', 'antrian.id_station')
        ->join('users', 'users.id', '=', 'antrian.id_users')
        ->join('items', 'items.id_items', '=', 'detail_transaksi.id_items')
        ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
        ->select('antrian.finish_time', 'items.nama_makanan', 'items.harga', 'detail_transaksi.jumlah', 'transaksi.total', 'transaksi.invoice', 'users.room', 'users.name')
        // ->where('transaksi.id', '=', $id)
        ->first();

        // $datetime_finish_time = $cetak_struk->finish_time;

        // $datetime_array_finish_time = explode(" ", $datetime_finish_time);

        // Ambil nilai jam, menit, dan detik dari bagian waktu

        // $time_array_finish_time = explode(":", $datetime_array_finish_time[1]);

        // $data2 = Transaksi::join('users', 'users.id', '=', 'transaksi.id_users')
        //                 ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')  
        //                 ->get();
        //                 $unik = $data2->unique('id_transaksi');

        return view('kasir.cetak_struk', [
            'cetak_struk' => $cetak_struk,
            // 'finish_time' => $time_array_finish_time,
            // 'data' => $unik,
        ]);
    }
}
