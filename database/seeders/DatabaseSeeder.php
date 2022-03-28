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
        // \App\Models\User::factory(10)->create();
       // $this->call(SectionsSeeder::class);
        //$this->call(citySeeder::class);
       // $this->call(About_us_Seeder::class);
        $this->call(UserSeeder::class);
        $this->call(setting_Seeder::class);
        // $this->call(Sub1Seeder::class);
        // $this->call(Sub2Seeder::class);
        //  $this->call(Sub3Seeder::class);
        //  $this->call(Sub4Seeder::class);
    }
}
