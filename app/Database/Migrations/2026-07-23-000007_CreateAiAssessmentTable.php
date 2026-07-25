<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAiAssessmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'victim_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'risk_level' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'confidence' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
            ],
            'clinical_priority' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kemungkinan_diagnosis' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'risiko_ptsd_berkembang' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'evidence_sources' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ai_summary' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'ai_generated',
            ],
            'generated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ai_assessment');
    }

    public function down()
    {
        $this->forge->dropTable('ai_assessment', true);
    }
}
