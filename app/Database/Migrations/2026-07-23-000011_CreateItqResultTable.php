<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItqResultTable extends Migration
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
            'ptsd_score' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'ptsd_severity' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'ptsd_percentile' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
            ],
            'ptsd_criteria_met' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'dso_score' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'dso_severity' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'dso_percentile' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
            ],
            'dso_criteria_met' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'overall_risk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'reviewed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'reviewed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('reviewed_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('itq_result');
    }

    public function down()
    {
        $this->forge->dropTable('itq_result', true);
    }
}
