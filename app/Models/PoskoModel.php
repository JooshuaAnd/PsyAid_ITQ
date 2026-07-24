<?php

namespace App\Models;

use CodeIgniter\Model;

class PoskoModel extends Model
{
    protected $table            = 'posko';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'regency_id', 'jenis_bencana', 'status'];

    public function getDistinctJenisBencana(): array
    {
        $builder = $this->builder();
        $query   = $builder->select('jenis_bencana')->distinct()->get();
        return array_column($query->getResultArray(), 'jenis_bencana');
    }
}
