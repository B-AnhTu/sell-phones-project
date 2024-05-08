<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_fullname' => 'Bùi Anh Tú',
            'username' => 'anhtu',
            'email' => 'anhtu@gmail.com',
            'password' => Hash::make('123456'),
            'user_type' => 1,
            'avatar' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([
                'user_fullname' => 'User'.$i,
                'username' => 'user'.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => Hash::make('123456'),
                'user_type' => 0,
                'avatar' => 'demouser.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
    }
}
