<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phones')->insert([
            'phone_name' => 'Iphone 6s',
            'phone_image' => null,
            'description' => 'Điện thoại iphone',
            'quantities' => 25,
            'price' => 2499000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 2,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Iphone 7s',
            'phone_image' => null,
            'description' => 'Điện thoại iphone',
            'quantities' => 43,
            'price' => 3499000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 2,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Samsung Galaxy A23',
            'phone_image' => null,
            'description' => 'Điện thoại samsung',
            'quantities' => 25,
            'price' => 3790000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 1,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Samsung Galaxy A50',
            'phone_image' => null,
            'description' => 'Điện thoại samsung',
            'quantities' => 25,
            'price' => 3999000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 1,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Huawei Mate P40 Pro',
            'phone_image' => null,
            'description' => 'Điện thoại Huawei',
            'quantities' => 48,
            'price' => 2899000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 3,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
