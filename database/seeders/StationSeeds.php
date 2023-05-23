<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StationSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //add items
        Station::truncate();
        Station::create([
            'id_users'      => 1,
            'nama_station'  => 'Makanan',
            'ket_station'   => 'Station ini bertugas untuk melakukan pembuatan makanan dan Snack',
            'jml_pekerja'   => 5,
        ]);
        Station::create([
            'id_users'      => 1,
            'nama_station'  => 'Minuman',
            'ket_station'   => 'Station ini bertugas untuk melakukan pembuatan minuman',
            'jml_pekerja'   => 5,
        ]);
    }
}
