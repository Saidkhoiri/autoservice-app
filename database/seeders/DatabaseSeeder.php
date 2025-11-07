<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ServiceTypeSeeder::class,
            UserSeeder::class,
            TechnicianSeeder::class,
            CustomerSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
