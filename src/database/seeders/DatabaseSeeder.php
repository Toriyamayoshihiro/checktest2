<?php

namespace Database\Seeders;

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
       $this->call(SeasonsTableSeeder::class);
       $this->call(ProductsTbaleSeeder::class);
       $this->call(ProductSeasonTableSeeder::class);
    }
}
