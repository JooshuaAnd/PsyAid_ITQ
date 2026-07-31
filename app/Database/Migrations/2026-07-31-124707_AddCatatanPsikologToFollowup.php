<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCatatanPsikologToFollowup extends Migration
{
    public function up()
    {
        $this->forge->addColumn('longitudinal_followup', [
            'catatan_psikolog' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('longitudinal_followup', 'catatan_psikolog');
    }
}
