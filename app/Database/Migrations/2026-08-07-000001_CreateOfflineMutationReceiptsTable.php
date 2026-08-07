<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfflineMutationReceiptsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'request_id' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'user_scope' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'public',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'processing',
            ],
            'response_code' => [
                'type' => 'SMALLINT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'completed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('request_id', true);
        $this->forge->addKey(['user_scope', 'status']);
        $this->forge->addKey('created_at');
        $this->forge->createTable('offline_mutation_receipts', true);

        // This is an internal server-side receipt table. On Supabase/Postgres,
        // deny Data API roles even when the project exposes public tables by
        // default. The direct backend connection remains the table owner.
        if ($this->db->DBDriver === 'Postgre') {
            $this->db->query('ALTER TABLE offline_mutation_receipts ENABLE ROW LEVEL SECURITY');
            $this->db->query(<<<'SQL'
DO $security$
BEGIN
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'anon') THEN
        REVOKE ALL ON TABLE offline_mutation_receipts FROM anon;
    END IF;
    IF EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'authenticated') THEN
        REVOKE ALL ON TABLE offline_mutation_receipts FROM authenticated;
    END IF;
END
$security$;
SQL);
        }
    }

    public function down()
    {
        $this->forge->dropTable('offline_mutation_receipts', true);
    }
}
