<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'user_id' => 1,
            'date_of_birth' => '2004-11-26',
            'gender' => 'Nam',
            'address' => 'Hồ Chí Minh',
            'phone_number' => '0987654321',
            'image' => 'demouser.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
