<?php

namespace App\Models;

use CodeIgniter\Model;

class DisasterInfoModel extends Model
{
    protected $table            = 'disaster_info';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'jenis_bencana', 'tanggal', 'durasi_terjebak',
        'mengungsi', 'kehilangan_rumah', 'kehilangan_keluarga',
        'cedera', 'rawat_inap', 'saksi_kematian'
    ];

    public function getByVictimId(int $victimId): ?array
    {
        return $this->where('victim_id', $victimId)->first();
    }
}
