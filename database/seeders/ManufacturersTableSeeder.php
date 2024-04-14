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
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('manufacturers')->insert([
            'manufacturer_name' => 'Apple',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('manufacturers')->insert([
            'manufacturer_name' => 'Huawei',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
