<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TransaksiSeeds extends Seeder
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
        Transaksi::truncate();
        Transaksi::create([
            'invoice'       =>  'FB/2023/Jan/001',
            'id_users'      =>  5,
            'total'         =>  25000,
            'metode'        =>  2,
            'status'        =>  2,
            'waktu_pesan'   =>  1,
        ]);
    }
}
