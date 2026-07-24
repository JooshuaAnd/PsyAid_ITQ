<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
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

        $this->db->table('users')->insertBatch($users);
    }
}
