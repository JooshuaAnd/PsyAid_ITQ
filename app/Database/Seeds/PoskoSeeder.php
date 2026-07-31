<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PoskoSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

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

        foreach ($poskoData as $p) {
            $exists = $db->table('posko')->where('id', $p['id'])->get()->getRow();
            if (!$exists) {
                $db->table('posko')->insert($p);
            } else {
                $db->table('posko')->where('id', $p['id'])->update($p);
            }
        }
    }
}
