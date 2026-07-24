<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePsychologistReviewTable extends Migration
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
            'chief_complaint' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_appearance' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_behavior' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_speech' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_mood' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_affect' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_thought' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_orientation' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mse_insight' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'reviewed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('psikolog_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('psychologist_review');
    }

    public function down()
    {
        $this->forge->dropTable('psychologist_review', true);
    }
}
