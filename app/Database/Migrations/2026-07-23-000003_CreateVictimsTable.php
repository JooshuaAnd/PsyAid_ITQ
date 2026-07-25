<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVictimsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'posko_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'umur' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
            ],
            'no_hp_keluarga' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_datang' => [
                'type' => 'DATE',
            ],
            'jam_datang' => [
                'type' => 'TIME',
            ],
            'ditemukan_oleh_relawan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('posko_id', 'posko', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ditemukan_oleh_relawan_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('victims');
    }

    public function down()
    {
        $this->forge->dropTable('victims', true);
    }
}
