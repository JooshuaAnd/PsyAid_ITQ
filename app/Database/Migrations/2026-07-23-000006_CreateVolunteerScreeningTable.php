<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVolunteerScreeningTable extends Migration
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
            'mampu_sebut_nama' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'mampu_sebut_lokasi' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'mampu_sebut_tanggal' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'kontak_mata' => [
                'type'       => 'ENUM',
                'constraint' => ['baik', 'kurang', 'tidak ada'],
            ],
            'bicara' => [
                'type'       => 'ENUM',
                'constraint' => ['normal', 'pelan', 'tidak menjawab', 'berteriak'],
            ],
            'menangis_terus' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'tampak_panik' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'sulit_ditenangkan' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'gemetar' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'berteriak_histeris' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'diam_total' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'menghindari_orang' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'menyebut_ingin_mati' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'mengancam_bunuh_diri' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'melukai_diri' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'agresif' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'mencari_keluarga' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'sulit_tidur' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'mimpi_buruk' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'tidak_mau_makan' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'skala_distress' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'catatan_relawan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'voice_note_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'video_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'dokumen_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'relawan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('relawan_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('volunteer_screening');
    }

    public function down()
    {
        $this->forge->dropTable('volunteer_screening', true);
    }
}
