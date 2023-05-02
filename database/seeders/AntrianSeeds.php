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
            'id_transaksi'              =>  1,
            'id_users'                  =>  1,
            'waktu_masuk'               =>  now(),
            'waktu_keluar'              =>  now(),
        ]);
       
    }
}
