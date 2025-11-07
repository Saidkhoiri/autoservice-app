<?php

namespace Database\Seeders;

use App\Models\Technician;
use Illuminate\Database\Seeder;

class TechnicianSeeder extends Seeder
{
    public function run()
    {
        Technician::create([
            'name' => 'Ahmad Supriadi',
            'phone' => '081234567890',
            'specialization' => 'Spesialis mesin dan transmisi',
            'is_active' => true,
        ]);

        Technician::create([
            'name' => 'Budi Santoso',
            'phone' => '081234567891',
            'specialization' => 'Spesialis kelistrikan dan AC',
            'is_active' => true,
        ]);

        Technician::create([
            'name' => 'Candra Wijaya',
            'phone' => '081234567892',
            'specialization' => 'Spesialis rem dan suspensi',
            'is_active' => true,
        ]);

        Technician::create([
            'name' => 'Dedi Kurniawan',
            'phone' => '081234567893',
            'specialization' => 'Spesialis tune up dan service berkala',
            'is_active' => true,
        ]);
    }
}
