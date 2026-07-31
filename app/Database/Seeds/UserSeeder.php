<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $defaultPassword = password_hash('password123', PASSWORD_BCRYPT);
        $now = date('Y-m-d H:i:s');

        $users = [
            [
                'name'          => 'Admin BPBD Pusat',
                'email'         => 'admin@psyaid.id',
                'password_hash' => $defaultPassword,
                'role'          => 'bpbd_admin',
                'posko_id'      => null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'name'          => 'Budi Santoso (Relawan Cianjur)',
                'email'         => 'relawan1@psyaid.id',
                'password_hash' => $defaultPassword,
                'role'          => 'relawan',
                'posko_id'      => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'name'          => 'Siti Rahma (Relawan Magelang)',
                'email'         => 'relawan2@psyaid.id',
                'password_hash' => $defaultPassword,
                'role'          => 'relawan',
                'posko_id'      => 2,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'name'          => 'Dr. Ahmad Hidayat, M.Psi',
                'email'         => 'psikolog1@psyaid.id',
                'password_hash' => $defaultPassword,
                'role'          => 'psikolog',
                'posko_id'      => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'name'          => 'Dra. Maya Indah, M.Psi',
                'email'         => 'psikolog2@psyaid.id',
                'password_hash' => $defaultPassword,
                'role'          => 'psikolog',
                'posko_id'      => 2,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        foreach ($users as $u) {
            $exists = $db->table('users')->where('email', $u['email'])->get()->getRow();
            if (!$exists) {
                $db->table('users')->insert($u);
            } else {
                $db->table('users')->where('email', $u['email'])->update($u);
            }
        }
    }
}
