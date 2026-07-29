<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndexToRegencies extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        // Check if index already exists before adding
        $query = $db->query("SHOW INDEX FROM regencies WHERE Key_name = 'idx_regencies_province_name'");
        if (empty($query->getResultArray())) {
            $db->query('ALTER TABLE regencies ADD INDEX idx_regencies_province_name (province_id, name)');
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SHOW INDEX FROM regencies WHERE Key_name = 'idx_regencies_province_name'");
        if (!empty($query->getResultArray())) {
            $db->query('ALTER TABLE regencies DROP INDEX idx_regencies_province_name');
        }
    }
}
