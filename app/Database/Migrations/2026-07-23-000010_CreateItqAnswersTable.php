<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItqAnswersTable extends Migration
{
    public function up()
    {
        $fields = [
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
        ];

        for ($i = 1; $i <= 18; $i++) {
            $fields['item_' . $i] = [
                'type'    => 'SMALLINT',
                'default' => 0,
            ];
        }

        $fields['created_at'] = [
            'type' => 'DATETIME',
            'null' => true,
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('victim_id', 'victims', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('psikolog_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('itq_answers');
    }

    public function down()
    {
        $this->forge->dropTable('itq_answers', true);
    }
}
