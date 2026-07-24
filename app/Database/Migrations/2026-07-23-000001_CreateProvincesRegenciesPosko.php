<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProvincesRegenciesPosko extends Migration
{
    public function up()
    {
        // 1. Table provinces
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('provinces');

        // 2. Table regencies
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'province_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('province_id', 'provinces', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('regencies');

        // 3. Table posko
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'regency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_bencana' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'recovery', 'closed'],
                'default'    => 'aktif',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('regency_id', 'regencies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('posko');
    }

    public function down()
    {
        $this->forge->dropTable('posko', true);
        $this->forge->dropTable('regencies', true);
        $this->forge->dropTable('provinces', true);
    }
}
