<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLongitudinalFollowupTable extends Migration
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
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'ptsd_score' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'dso_score' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'recorded_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('longitudinal_followup');
    }

    public function down()
    {
        $this->forge->dropTable('longitudinal_followup', true);
    }
}
