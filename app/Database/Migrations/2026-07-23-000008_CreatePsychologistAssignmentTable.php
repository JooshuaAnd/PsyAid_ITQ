<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePsychologistAssignmentTable extends Migration
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
            'psikolog_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'assigned_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'jumlah_kasus_saat_assign' => [
                'type'    => 'INT',
                'default' => 0,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('psikolog_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('psychologist_assignment');
    }

    public function down()
    {
        $this->forge->dropTable('psychologist_assignment', true);
    }
}
