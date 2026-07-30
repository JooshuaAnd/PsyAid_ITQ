<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDisasterReportsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ticket_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'jenis_bencana' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'lokasi_bencana' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'tanggal_bencana' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'status_berlangsung' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Ya',
            ],
            'skala_keparahan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'catatan_tambahan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'proses', 'selesai', 'ditolak'],
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
        $this->forge->addUniqueKey('ticket_code');
        $this->forge->createTable('disaster_reports', true);
    }

    public function down()
    {
        $this->forge->dropTable('disaster_reports', true);
    }
}
