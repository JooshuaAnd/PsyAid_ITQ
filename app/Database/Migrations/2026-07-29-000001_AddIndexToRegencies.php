<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndexToRegencies extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $driver = strtolower($db->DBDriver);

        if (strpos($driver, 'postgre') !== false || strpos($driver, 'postgres') !== false) {
            $check = $db->query("SELECT 1 FROM pg_indexes WHERE tablename = 'regencies' AND indexname = 'idx_regencies_province_name'");
            if (empty($check->getResultArray())) {
                $db->query('CREATE INDEX idx_regencies_province_name ON regencies (province_id, name)');
            }
        } else {
            // MySQL / SQLite / Default
            $check = $db->query("SHOW INDEX FROM regencies WHERE Key_name = 'idx_regencies_province_name'");
            if (empty($check->getResultArray())) {
                $db->query('CREATE INDEX idx_regencies_province_name ON regencies (province_id, name)');
            }
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $driver = strtolower($db->DBDriver);

        if (strpos($driver, 'postgre') !== false || strpos($driver, 'postgres') !== false) {
            $db->query('DROP INDEX IF EXISTS idx_regencies_province_name');
        } else {
            // MySQL / SQLite / Default
            $check = $db->query("SHOW INDEX FROM regencies WHERE Key_name = 'idx_regencies_province_name'");
            if (!empty($check->getResultArray())) {
                $db->query('DROP INDEX idx_regencies_province_name ON regencies');
            }
        }
    }
}
