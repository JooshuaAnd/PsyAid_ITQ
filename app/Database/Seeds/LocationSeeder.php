<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        // Insert Provinces
        $provinces = [
            ['id' => 1, 'name' => 'Jawa Barat'],
            ['id' => 2, 'name' => 'Jawa Tengah'],
        ];

        $this->db->table('provinces')->insertBatch($provinces);

        // Insert Regencies
        $regencies = [
            ['id' => 1, 'province_id' => 1, 'name' => 'Kabupaten Cianjur'],
            ['id' => 2, 'province_id' => 1, 'name' => 'Kabupaten Sukabumi'],
            ['id' => 3, 'province_id' => 2, 'name' => 'Kabupaten Magelang'],
            ['id' => 4, 'province_id' => 2, 'name' => 'Kabupaten Karanganyar'],
        ];

        $this->db->table('regencies')->insertBatch($regencies);
    }
}
