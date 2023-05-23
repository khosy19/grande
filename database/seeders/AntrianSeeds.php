<?php

namespace Database\Seeders;

use App\Models\Antrian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Transaksi;

class AntrianSeeds extends Seeder
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
        Antrian::truncate();
        Antrian::create([
            'id_antrian'                =>  1,
            'id_detail_transaksi'       =>  1,
            'id_users'                  =>  1,
            'id_station'                =>  1,
            'waktu_tiba'                =>  date("H:i:s"),
            'start_time'                =>  date("H:i:s"),
            'burst_time'                =>  date("H:i:s"),
            'finish_time'               =>  date("H:i:s"),
            'tat'                       =>  date("H:i:s"),
            'waiting_time'              =>  date("H:i:s"),
        ]);
       
    }
}
