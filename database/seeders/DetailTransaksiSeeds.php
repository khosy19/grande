<?php

namespace Database\Seeders;

use App\Models\Detail_transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Transaksi;

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
        Detail_transaksi::create([
            'id_detail_transaksi'       =>  1,
            'id_transaksi'              =>  1,
            'id_items'                  =>  1,
            'jumlah'                    =>  1,

        ]);    
    }
}
