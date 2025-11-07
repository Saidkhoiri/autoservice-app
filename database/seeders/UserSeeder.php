<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Bengkel',
                'email' => 'admin@demo.com',
                'password' => Hash::make('password123'),
                'role_id' => 2, // admin
                'phone' => '081234567890',
                'address' => 'Jl. Bengkel No. 1, Jakarta',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik Bengkel',
                'email' => 'owner@demo.com',
                'password' => Hash::make('password123'),
                'role_id' => 3, // owner
                'phone' => '081234567891',
                'address' => 'Jl. Bengkel No. 1, Jakarta',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelanggan Demo',
                'email' => 'customer@demo.com',
                'password' => Hash::make('password123'),
                'role_id' => 1, // customer
                'phone' => '081234567892',
                'address' => 'Jl. Pelanggan No. 1, Jakarta',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
