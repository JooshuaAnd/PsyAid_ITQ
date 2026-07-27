<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVolunteerRegistrationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'posko_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
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
        $this->forge->createTable('volunteer_registrations', true);
    }

    public function down()
    {
        $this->forge->dropTable('volunteer_registrations', true);
    }
}
