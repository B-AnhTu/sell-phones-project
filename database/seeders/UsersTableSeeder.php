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
            'password' => Hash::make('password'),
            'user_type' => 1,
            'avatar' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'user_fullname' => 'Nguyễn Thanh Toàn',
            'username' => 'thanhtoan123',
            'email' => 'thanhtoan123@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 0,
            'avatar' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'user_fullname' => 'Hồ Cẩm Ty',
            'username' => 'hocamty',
            'email' => 'hocamty@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 0,
            'avatar' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
