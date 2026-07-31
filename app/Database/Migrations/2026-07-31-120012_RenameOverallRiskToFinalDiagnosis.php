<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameOverallRiskToFinalDiagnosis extends Migration
{
    public function up()
    {
        $fields = [
            'overall_risk' => [
                'name'       => 'final_diagnosis',
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ];
        $this->forge->modifyColumn('itq_result', $fields);
    }

    public function down()
    {
        $fields = [
            'final_diagnosis' => [
                'name'       => 'overall_risk',
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ];
        $this->forge->modifyColumn('itq_result', $fields);
    }
}
