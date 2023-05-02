<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use App\Models\Detail_transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DetailTransaksiSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //buat user admin
        Detail_transaksi::truncate();
        // DB::table('detail_transaksi')->delete();
        Detail_transaksi::create([
            'id_detail_transaksi'       =>  1,
            'id_transaksi'              =>  1,
            'id_items'                  =>  1,
            'jumlah'                    =>  1,
            'waktu_pesan'               =>  now(),
            'waktu_selesai'             =>  now(),
        ]);
        Detail_transaksi::create([
            'id_detail_transaksi'       =>  2,
            'id_transaksi'              =>  2,
            'id_items'                  =>  9,
            'jumlah'                    =>  1,
            'waktu_pesan'               =>  now(),
            'waktu_selesai'             =>  now(),
        ]);  
        Detail_transaksi::create([
            'id_detail_transaksi'       =>  3,
            'id_transaksi'              =>  3,
            'id_items'                  =>  1,
            'jumlah'                    =>  1,
            'waktu_pesan'               =>  now(),
            'waktu_selesai'             =>  now(),
        ]);  
        Detail_transaksi::create([
            'id_detail_transaksi'       =>  4,
            'id_transaksi'              =>  4,
            'id_items'                  =>  9,
            'jumlah'                    =>  1,
            'waktu_pesan'               =>  now(),
            'waktu_selesai'             =>  now(),
        ]);      
    }
}
