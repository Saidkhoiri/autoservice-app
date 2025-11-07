<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_types')->insert([
            [
                'name' => 'Ganti Oli Mesin',
                'description' => 'Penggantian oli mesin dengan oli berkualitas tinggi',
                'price' => 150000,
                'duration_minutes' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ganti Oli Gardan',
                'description' => 'Penggantian oli gardan untuk performa optimal',
                'price' => 80000,
                'duration_minutes' => 20,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ganti Filter Udara',
                'description' => 'Penggantian filter udara untuk efisiensi bahan bakar',
                'price' => 50000,
                'duration_minutes' => 15,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tune Up',
                'description' => 'Penyetelan mesin untuk performa optimal',
                'price' => 200000,
                'duration_minutes' => 60,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ganti Kampas Rem',
                'description' => 'Penggantian kampas rem depan dan belakang',
                'price' => 300000,
                'duration_minutes' => 90,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Service AC',
                'description' => 'Pembersihan dan pengisian freon AC',
                'price' => 250000,
                'duration_minutes' => 120,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
