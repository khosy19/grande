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
            'nama_makanan'  => 'Cozy Pizza Benefito',
            'deskripsi' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'harga' => 35000,
            'foto'  => 'pizza.jpeg',
            'tipe'  => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Cozy burger',
            'deskripsi' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'harga' => 45000,
            'foto'  => 'burger.jpeg',
            'tipe'  => 1,
        ]);

        Items::create([
            'nama_makanan'  => 'Jack Daniels',
            'deskripsi' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'harga' => 700000,
            'foto'  => 'jack.jpeg',
            'tipe'  => 2,
        ]);

        Items::create([
            'nama_makanan'  => 'Gentleman Jack',
            'deskripsi' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'harga' => 325000,
            'foto'  => 'gentlement.jpeg',
            'tipe'  => 2,
        ]);

        Items::create([
            'nama_makanan'  => 'Sandwich avocado',
            'deskripsi' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'harga' => 25000,
            'foto'  => 'avocado.jpeg',
            'tipe'  => 1,
        ]);
        
    }
}
