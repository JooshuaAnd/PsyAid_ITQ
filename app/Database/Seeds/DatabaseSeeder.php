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
    }
}
