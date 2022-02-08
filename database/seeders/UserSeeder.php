<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        $user_data = array(
            array(
                'name' => "admin",
                'type' => "admin",
                'email'=>'admin@eradunited.com',
                'email_verified_at'=>date('Y-m-d H:i:s'),
                'password'=>Hash::make('admin123'),
                
                
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                ),
        );
        DB::table('users')->insert($user_data);
    }
}
