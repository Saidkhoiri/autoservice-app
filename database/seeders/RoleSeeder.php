<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'customer',
                'display_name' => 'Pelanggan',
                'description' => 'Pelanggan yang dapat melakukan booking dan melihat status pesanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin Bengkel',
                'description' => 'Admin yang mengelola jadwal booking, teknisi, dan daftar jasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'owner',
                'display_name' => 'Pemilik Bengkel',
                'description' => 'Pemilik yang memiliki akses penuh termasuk laporan pendapatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
