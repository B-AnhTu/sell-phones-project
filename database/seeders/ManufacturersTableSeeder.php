<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manufacturers')->insert([
            'manufacturer_name' => 'Samsung',
            'image' => 'logo_samsung.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('manufacturers')->insert([
            'manufacturer_name' => 'Apple',
            'image' => 'logo_apple.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('manufacturers')->insert([
            'manufacturer_name' => 'Huawei',
            'image' => 'logo_huawei.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('manufacturers')->insert([
            'manufacturer_name' => 'Oppo',
            'image' => 'logo_oppo.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
