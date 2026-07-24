<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePsychologicalHistoryTable extends Migration
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
            'pernah_konsultasi' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'pernah_dirawat_psikiater' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'diagnosis_sebelumnya' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sedang_konsumsi_obat' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'nama_obat' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'dosis' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'dokter' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'riwayat_percobaan_bunuh_diri' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'riwayat_melukai_diri' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'riwayat_napza' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'riwayat_penyakit_kronis' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'keterangan_penyakit_kronis' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('psychological_history');
    }

    public function down()
    {
        $this->forge->dropTable('psychological_history', true);
    }
}
