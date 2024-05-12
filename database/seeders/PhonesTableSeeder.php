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
            'phone_name' => 'Iphone 5s',
            'phone_image' => 'iphone5s.png',
            'description' => 'Điện thoại iphone',
            'quantities' => 62,
            'price' => 3999000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 2,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Iphone 6s',
            'phone_image' => 'iphone6.png',
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
            'phone_image' => 'ip7s.png',
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
            'phone_image' => 'samsunga15.png',
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
            'phone_image' => 'samsunga50.png',
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
            'phone_image' => 'huawei_p50_pro.jpg',
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
        DB::table('phones')->insert([
            'phone_name' => 'Xiaomi Redmi Note 13',
            'phone_image' => 'xiaomi-redmi-note-13.webp',
            'description' => 'Điện thoại Huawei',
            'quantities' => 62,
            'price' => 5699000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 3,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Máy tính HP',
            'phone_image' => 'maytinhHP.png',
            'description' => 'Windows 11**
            Bộ xử lý lên tới Intel® Core™ Ultra 7 155H (lên tới 4,8 GHz với công nghệ Intel® Turbo Boost)2
            Màn hình cảm ứng cải tiến IMAX OLED 14" (35,6 cm)3
            1,56kg4',
            'quantities' => 62,
            'price' => 5699000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 3,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('phones')->insert([
            'phone_name' => 'Iphone 15 Pro',
            'phone_image' => 'iphone15pro.jpg',
            'description' => 'Điện thoại iphone',
            'quantities' => 62,
            'price' => 5699000,
            'status' => 1,
            'purchases' => 0,
            'manu_id' => 2,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        for ($i=0; $i < 10; $i++) { 
            DB::table('phones')->insert([
                'phone_name' => 'Iphone 1'.$i,
                'phone_image' => 'iphone15pro.jpg',
                'description' => 'Điện thoại iphone',
                'quantities' => 60,
                'price' => 5699000,
                'status' => 1,
                'purchases' => 0,
                'manu_id' => 2,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
