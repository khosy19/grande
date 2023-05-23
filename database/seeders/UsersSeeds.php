<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UsersSeeds extends Seeder
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
        User::truncate();
        User::create([
            'name'  => 'admin',
            'room' => 'admin@admin.com',
            'level' => 'admin',
            'password' => bcrypt('admin'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);

        //buat user kasir
        User::create([
            'name'  => 'Lala Savitri',
            'room' => 'lala@kasir.com',
            'level' => 'kasir',
            'password' => bcrypt('kasir'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Rahma Yudianti',
            'room' => 'rahma@kasir.com',
            'level' => 'kasir',
            'password' => bcrypt('kasir'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        //buat user produksi
        User::create([
            'name'  => 'Yudhistira Ardiansyah',
            'room' => 'yudistira@produksi.com',
            'level' => 'produksi',
            'password' => bcrypt('produksi'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        //buat user meja
        User::create([
            'name'  => 'Sebelah Kasir',
            'room' => 'm001',
            'level' => 'guest',
            'password' => bcrypt('m001'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name'  => 'Sebelah Kasir',
            'room' => 'm002',
            'level' => 'guest',
            'password' => bcrypt('m002'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Sebelah Outbond',
            'room' => 'm003',
            'level' => 'guest',
            'password' => bcrypt('m003'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Sebelah Outbond',
            'room' => 'm004',
            'level' => 'guest',
            'password' => bcrypt('m004'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Di Taman',
            'room' => 'm005',
            'level' => 'guest',
            'password' => bcrypt('m005'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Di Taman',
            'room' => 'm006',
            'level' => 'guest',
            'password' => bcrypt('m006'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Sebelah Karaoke',
            'room' => 'm007',
            'level' => 'guest',
            'password' => bcrypt('m007'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name'  => 'Sebelah Karaoke',
            'room' => 'm008',
            'level' => 'guest',
            'password' => bcrypt('m008'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name'  => 'Dekat Parkir',
            'room' => 'm009',
            'level' => 'guest',
            'password' => bcrypt('m009'),
            'active'=> '0',
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name'  => 'Dekat Parkir',
            'room' => 'm010',
            'level' => 'guest',
            'password' => bcrypt('m010'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
    }
}
