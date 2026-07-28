<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRecruitmentFieldsToPosko extends Migration
{
    public function up()
    {
        $fields = [
            'quota' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 10,
                'after'      => 'status',
            ],
            'filled' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'quota',
            ],
            'urgency' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Urgent',
                'after'      => 'filled',
            ],
            'positions' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'urgency',
            ],
            'requirements' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'positions',
            ],
            'contact_person' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'requirements',
            ],
        ];

        $db = \Config\Database::connect();
        if ($db->tableExists('posko')) {
            foreach ($fields as $columnName => $columnDef) {
                if (! $db->fieldExists($columnName, 'posko')) {
                    $this->forge->addColumn('posko', [$columnName => $columnDef]);
                }
            }
        }
    }

    public function down()
    {
        // No-op for safety
    }
}
