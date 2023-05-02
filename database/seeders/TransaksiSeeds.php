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
            'invoice'       =>  'TRANS/2023/Jan/001',
            'id_users'      =>  5,
            'total'         =>  25000,
            'metode'        =>  2,
            'status'        =>  1,
        ]);
        Transaksi::create([
            'invoice'       =>  'TRANS/2023/Jan/001',
            'id_users'      =>  5,
            'total'         =>  7000,
            'metode'        =>  1,
            'status'        =>  1,
        ]);
        Transaksi::create([
            'invoice'       =>  'TRANS/2023/Jan/002',
            'id_users'      =>  6,
            'total'         =>  25000,
            'metode'        =>  1,
            'status'        =>  1,
        ]);
        Transaksi::create([
            'invoice'       =>  'TRANS/2023/Jan/003',
            'id_users'      =>  7,
            'total'         =>  7000,
            'metode'        =>  1,
            'status'        =>  1,
            // 'waktu_pesan'   =>  1,
        ]);
    }
}
