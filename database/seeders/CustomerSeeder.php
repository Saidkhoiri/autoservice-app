<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567894',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'role_id' => 1, // customer
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '081234567895',
            'address' => 'Jl. Thamrin No. 456, Jakarta Pusat',
            'role_id' => 1, // customer
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
            'phone' => '081234567896',
            'address' => 'Jl. Gatot Subroto No. 789, Jakarta Selatan',
            'role_id' => 1, // customer
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);
    }
}
