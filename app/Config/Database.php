<?php

namespace Config;

use CodeIgniter\Database\Config;
use RuntimeException;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => '',
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'schema'       => 'public',
        'DBDriver'     => 'Postgre',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollat'     => '',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 5432,
        'numberNative' => false,
        'foundRows'    => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => true,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'synchronous' => null,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if testing
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
            return;
        }

        $this->configureDatabaseFromEnv();
    }

    /**
     * Automatically configure database parameters from Railway or local environment variables.
     */
    private function configureDatabaseFromEnv(): void
    {
        // 1. Fetch Railway / PostgreSQL specific env variables
        $dbUrl  = env('DATABASE_URL', getenv('DATABASE_URL') ?: getenv('DATABASE_PUBLIC_URL'));
        $pgHost = env('PGHOST', getenv('PGHOST') ?: getenv('POSTGRES_HOST'));
        $pgDb   = env('PGDATABASE', getenv('PGDATABASE') ?: getenv('POSTGRES_DB'));
        $pgUser = env('PGUSER', getenv('PGUSER') ?: getenv('POSTGRES_USER'));
        $pgPass = env('PGPASSWORD', getenv('PGPASSWORD') ?: getenv('POSTGRES_PASSWORD'));
        $pgPort = env('PGPORT', getenv('PGPORT') ?: getenv('POSTGRES_PORT'));

        // 2. Fetch standard CodeIgniter env overrides
        $ciDriver = env('database.default.DBDriver', getenv('database.default.DBDriver'));
        $ciHost   = env('database.default.hostname', getenv('database.default.hostname'));
        $ciDb     = env('database.default.database', getenv('database.default.database'));
        $ciUser   = env('database.default.username', getenv('database.default.username'));
        $ciPass   = env('database.default.password', getenv('database.default.password'));
        $ciPort   = env('database.default.port', getenv('database.default.port'));

        // If DATABASE_URL / DATABASE_PUBLIC_URL is provided, parse it
        if (!empty($dbUrl)) {
            $parsed = parse_url($dbUrl);
            if ($parsed !== false) {
                $pgHost = $parsed['host'] ?? $pgHost;
                $pgPort = $parsed['port'] ?? $pgPort;
                $pgUser = $parsed['user'] ?? $pgUser;
                $pgPass = $parsed['pass'] ?? $pgPass;
                if (!empty($parsed['path'])) {
                    $pgDb = ltrim($parsed['path'], '/');
                }
            }
        }

        // Determine effective values
        $host     = $pgHost ?: $ciHost;
        $database = $pgDb ?: $ciDb;
        $username = $pgUser ?: $ciUser;
        $password = $pgPass !== null ? $pgPass : $ciPass;
        $port     = $pgPort ?: ($ciPort ?: 5432);
        $driver   = (!empty($pgHost) || !empty($dbUrl)) ? 'Postgre' : (strtolower((string)$ciDriver) === 'mysqli' ? 'MySQLi' : 'Postgre');

        // Check if database parameters are missing
        if (empty($host) || empty($database) || empty($username)) {
            throw new RuntimeException(
                "Environment variable Database tidak lengkap. " .
                "Harap atur PGHOST, PGDATABASE, PGUSER, dan PGPASSWORD di Railway atau .env file."
            );
        }

        $this->default['DBDriver'] = $driver;
        $this->default['hostname'] = $host;
        $this->default['database'] = $database;
        $this->default['username'] = $username;
        $this->default['password'] = (string)$password;
        $this->default['port']     = (int)$port;
        $this->default['schema']   = 'public';
        $this->default['charset']  = $driver === 'Postgre' ? 'utf8' : 'utf8mb4';
    }
}
