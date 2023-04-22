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
        //buat user kamar
        User::create([
            'name'  => 'Bima Satria Putri',
            'room' => 'B110',
            'level' => 'guest',
            'password' => bcrypt('admin'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name'  => 'Toddi Nonlangga',
            'room' => 'B210',
            'level' => 'guest',
            'password' => bcrypt('admin'),
            'active'=> '0',
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name'  => 'Leonardo De Caprio',
            'room' => 'B310',
            'level' => 'guest',
            'password' => bcrypt('admin'),
            'active'=> '1',
            'remember_token' => Str::random(60),
        ]);
    }
}
