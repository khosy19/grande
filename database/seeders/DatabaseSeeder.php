<?php

namespace Database\Seeders;

use App\Models\Antrians;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeds::class);
        $this->call(ItemsSeeds::class);
        $this->call(StationSeeds::class);
        $this->call(TransaksiSeeds::class);
        $this->call(DetailTransaksiSeeds::class);
        $this->call(AntrianSeeds::class);
    }
}
