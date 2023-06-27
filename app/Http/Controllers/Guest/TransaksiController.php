<?php

namespace App\Http\Controllers\Guest;

use Auth;
use Session;
use DB;
use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\Antrian_minum;
use App\Models\Station;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use App\Models\Detail_transaksi_minum;
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

        $id_station = Station::orderby('id_station', 'desc')->first()->id_station;

        foreach($cart as $item =>$val){
            $id_items = $val['id_items'];
            $jumlah = $val['jumlah'];
            $waktu_items = $val['waktu_items'];
            $tipe = $val['jenis_items'];

            $burst = $waktu_items * $jumlah;

            $waktu_awal = date('H:i:s');
            $cekData = DB::table('antrian')->count(); 

            $previousData = DB::table('antrian')
                                ->select('start_time', 'burst_time')
                                ->orderBy('start_time', 'desc')
                                ->limit(1)
                                ->get();
                                

            // menghitung start time
            if ($previousData->isNotEmpty()) {
                $startTime = $previousData[0]->start_time;
                $burst_data = $previousData[0]->burst_time;

                $dateTime = Carbon::createFromFormat('H:i:s', $startTime);
                $dateTime->addMinutes($burst_data);

                $ST = $dateTime->format('H:i:s');
                
            }
            else{
                $ST = $waktu_awal;
            }


            // menghitung waiting time
            $StartDateTime = Carbon::createFromFormat('H:i:s', $ST);
            $WaktuTibaTime = Carbon::createFromFormat('H:i:s', $waktu_awal);

            $WT = $StartDateTime->diffInMinutes($WaktuTibaTime);

            // menghitung finish time
            $Start_Time_Date = Carbon::createFromFormat('H:i:s', $ST);
            $Start_Time_Date->addMinutes($burst);

            $FT  = $Start_Time_Date->format('H:i:s');
            
            // menghitung tat
            // $FinishDatesTime = Carbon::createFromFormat('H:i:s', $FT);
            // $WaktuTibaHE = Carbon::createFromFormat('H:i:s', $WT);

            // $TAT = $FinishDatesTime->diffInMinutes($waktu_awal);
        
            // return $FT;
            // die();
            
            // makanan 1, minuman 2
            if($tipe == 1){
                Detail_transaksi::create([
                    'id_transaksi' => $id_transaksi,
                    'id_items'     => $id_items,
                    'jumlah'       => $jumlah,
                ]);

                Antrian::create([
                    'id_detail_transaksi' => $id_transaksi,
                    'id_station'          => $id_station,
                    'id_users'            => $id_user,
                    'waktu_tiba'          => $waktu_awal,
                    'start_time'          => ($cekData > 0) ? $ST : $waktu_awal,
                    'burst_time'          => $burst,
                    'waiting_time'        => $WT,
                    'finish_time'         => $FT,
                    'tat'                 => 0,
                ]);
            }else{
                Detail_transaksi_minum::create([
                    'id_transaksi_minuman' => $id_transaksi,
                    'id_items_minuman'     => $id_items,
                    'jumlah_minuman'       => $jumlah,
                ]);

                Antrian_minum::create([
                    'id_detail_transaksi_minum' => $id_transaksi,
                    'id_station_minum'          => $id_station,
                    'id_users_minum'            => $id_user,
                    'waktu_tiba_minum'          => $waktu_awal,
                    'start_time_minum'          => ($cekData > 0) ? $ST : $waktu_awal,
                    'burst_time_minum'          => $burst,
                    'waiting_time_minum'        => $WT,
                    'finish_time_minum'         => $FT,
                    'tat_minum'                 => 0,
                ]);
            }

            
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
