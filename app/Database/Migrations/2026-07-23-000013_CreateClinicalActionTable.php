<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClinicalActionTable extends Migration
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
            'psikolog_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ai_recommendation_approved' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'priority_override' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'diagnosis_sementara' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'intervensi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'catatan_klinis' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'jadwal_followup' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'ai_generated',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('psikolog_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('clinical_action');
    }

    public function down()
    {
        $this->forge->dropTable('clinical_action', true);
    }
}
