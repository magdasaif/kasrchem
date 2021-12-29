<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Sections extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_sections')->delete();
        $data=[
           
        ];
    }
}
