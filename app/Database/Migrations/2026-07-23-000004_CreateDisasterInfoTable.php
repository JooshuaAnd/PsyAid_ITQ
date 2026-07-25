<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDisasterInfoTable extends Migration
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
            'victim_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_bencana' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'durasi_terjebak' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'mengungsi' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'kehilangan_rumah' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'kehilangan_keluarga' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'cedera' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'rawat_inap' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'saksi_kematian' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('disaster_info');
    }

    public function down()
    {
        $this->forge->dropTable('disaster_info', true);
    }
}
