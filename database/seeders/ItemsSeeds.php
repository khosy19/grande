<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ItemsSeeds extends Seeder
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
        Items::truncate();
        Items::create([
            'nama_makanan'  => 'Ayam Taliwang',
            'deskripsi'     => 'Ayam Taliwang dengan sambal',
            'harga'         => 25000,
            'foto'          => 'menu/ayam_taliwang.jpg',
            'tipe'          => 1,
            'waktu_menu'    => 10,
            'aktif'         => 1,
        ]);
        
        Items::create([
            'nama_makanan'  => 'Blukutuk Lele',
            'deskripsi'     => 'Blukutuk Lele dengan sambal goreng',
            'harga'         => 14000,
            'foto'          => 'menu/blukutuk_lele.jpg',
            'tipe'          => 1,
            'waktu_menu'    => 10,
            'aktif'         => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Churos Coklat',
            'deskripsi'     => 'Camilan Churos dengan coklat nutella',
            'harga'         => 12000,
            'foto'          => 'menu/churos_coklat.jpg',
            'tipe'          => 1,
            'waktu_menu'    => 10,
            'aktif'         => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Air Mineral Cleo',
            'deskripsi'     => 'Air Mineral Cleo Bisa Dingin/Biasa',
            'harga'         => 6000,
            'foto'          => 'menu/cleo.jpg',
            'tipe'          => 2,
            'waktu_menu'    => 1,
            'aktif'         => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Dori Blackpaper',
            'deskripsi'     => 'Ikan dori dengan saus blackpaper',
            'harga'         => 22000,
            'foto'          => 'menu/dori_blackpaper.jpg',
            'tipe'          => 1,
            'waktu_menu'    => 15,
            'aktif'         => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Es Teh',
            'deskripsi'     => 'Es Teh dengan Racikan khusus Grande',
            'harga'         => 6000,
            'foto'          => 'menu/es_teh.jpg',
            'tipe'          => 2,
            'waktu_menu'    => 3,
            'aktif'         => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Fish And Chips',
            'deskripsi'     => 'Ikan dipotong dan digoreng dengan kentang goreng',
            'harga'         => 25000,
            'foto'          => 'menu/fish_and_chips.jpg',
            'tipe'          => 1,
            'waktu_menu'    => 10,
            'aktif'         => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Frapper Milo Mochachip',
            'deskripsi'     => 'Milo dengan Frappe khas Grande',
            'harga'         => 18000,
            'foto'          => 'menu/frappe_milo.jpg',
            'tipe'          => 2,
            'waktu_menu'    => 7,
            'aktif'         => 2,
        ]);

        Items::create([
            'nama_makanan'  => 'Kopi Susu',
            'deskripsi'     => 'Kopi yang digiling sendiri khas Grande ditambahkan fresh milk',
            'harga'         => 7000,
            'foto'          => 'menu/kopi_susu.jpg',
            'tipe'          => 2,
            'waktu_menu'    => 5,
            'aktif'         => 2,
        ]);

        Items::create([
            'nama_makanan'  => 'Snack Platter',
            'deskripsi'     => 'Snack yang berisi kentang dan nugget',
            'harga'         => 22000,
            'foto'          => 'menu/snack_platter.jpg',
            'tipe'          => 1,
            'waktu_menu'    => 15,
            'aktif'         => 1,
        ]);
    }
}
