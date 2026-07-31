<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFaseKeToAssessments extends Migration
{
    public function up()
    {
        $fields = [
            'fase_ke' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
        ];

        $this->forge->addColumn('itq_answers', $fields);
        $this->forge->addColumn('itq_result', $fields);
        $this->forge->addColumn('psychologist_review', $fields);
        $this->forge->addColumn('ai_assessment', $fields);

        // For final decision in clinical_action
        $clinicalFields = [
            'fase_ke' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'status_akhir' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'catatan_akhir' => [
                'type'       => 'TEXT',
                'null'       => true,
            ]
        ];
        $this->forge->addColumn('clinical_action', $clinicalFields);
    }

    public function down()
    {
        $this->forge->dropColumn('itq_answers', 'fase_ke');
        $this->forge->dropColumn('itq_result', 'fase_ke');
        $this->forge->dropColumn('psychologist_review', 'fase_ke');
        $this->forge->dropColumn('ai_assessment', 'fase_ke');
        
        $this->forge->dropColumn('clinical_action', 'fase_ke');
        $this->forge->dropColumn('clinical_action', 'status_akhir');
        $this->forge->dropColumn('clinical_action', 'catatan_akhir');
    }
}
