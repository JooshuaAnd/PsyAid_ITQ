<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('LocationSeeder');
        $this->call('PoskoSeeder');
        $this->call('UserSeeder');
        $this->call('DummyVictimSeeder');

        $this->syncPostgresSequences();
    }

    private function syncPostgresSequences()
    {
        $db = \Config\Database::connect();
        $driver = strtolower($db->DBDriver);

        if (strpos($driver, 'postgre') !== false || strpos($driver, 'postgres') !== false || strpos($driver, 'pgsql') !== false) {
            $tables = [
                'provinces',
                'regencies',
                'posko',
                'users',
                'victims',
                'disaster_info',
                'psychological_history',
                'volunteer_screening',
                'ai_assessment',
                'psychologist_assignment',
                'psychologist_review',
                'itq_answers',
                'itq_result',
                'longitudinal_followup',
                'clinical_action',
                'volunteer_registrations',
                'disaster_reports',
            ];

            foreach ($tables as $table) {
                if ($db->tableExists($table)) {
                    $sql = "SELECT setval(pg_get_serial_sequence('{$table}', 'id'), COALESCE((SELECT MAX(id) FROM {$table}), 1), true)";
                    try {
                        $db->query($sql);
                    } catch (\Throwable $e) {
                        // Skip if table or sequence doesn't exist
                    }
                }
            }
        }
    }
}
