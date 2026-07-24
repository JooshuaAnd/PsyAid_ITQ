<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PoskoSeeder extends Seeder
{
    public function run()
    {
        $poskoData = [
            [
                'id'            => 1,
                'name'          => 'Posko Utama Pengungsian Cianjur',
                'regency_id'    => 1,
                'jenis_bencana' => 'Gempa Bumi',
                'status'        => 'aktif',
            ],
            [
                'id'            => 2,
                'name'          => 'Posko Tanggap Darurat Merapi Magelang',
                'regency_id'    => 3,
                'jenis_bencana' => 'Erupsi Gunung Berapi',
                'status'        => 'aktif',
            ],
            [
                'id'            => 3,
                'name'          => 'Posko Pemulihan Karanganyar',
                'regency_id'    => 4,
                'jenis_bencana' => 'Banjir & Tanah Longsor',
                'status'        => 'recovery',
            ],
        ];

        $this->db->table('posko')->insertBatch($poskoData);
    }
}
