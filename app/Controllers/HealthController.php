<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;
use Throwable;

class HealthController extends Controller
{
    /**
     * Check PostgreSQL / Database connection status.
     * Returns JSON response with connection details or error message.
     */
    public function database()
    {
        $response = $this->response->setHeader('Content-Type', 'application/json');

        try {
            $dbConfig = config('Database');
            $db = Database::connect('default');

            // Force connection test
            $db->initialize();
            
            // Execute simple test query
            $query = $db->query('SELECT 1');

            if ($query) {
                return $response->setStatusCode(200)->setJSON([
                    'status'   => 'connected',
                    'database' => $dbConfig->default['database'] ?? $db->getDatabase(),
                    'host'     => $dbConfig->default['hostname'] ?? $db->hostname,
                    'driver'   => $dbConfig->default['DBDriver'] ?? 'Postgre',
                ]);
            }

            return $response->setStatusCode(500)->setJSON([
                'status'  => 'failed',
                'message' => 'Query test database gagal.',
            ]);
        } catch (Throwable $e) {
            return $response->setStatusCode(500)->setJSON([
                'status'  => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
