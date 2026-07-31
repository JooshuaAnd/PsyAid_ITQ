<?php

namespace App\Models;

use CodeIgniter\Model;

class ClinicalActionModel extends Model
{
    protected $table            = 'clinical_action';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'psikolog_id', 'ai_recommendation_approved',
        'priority_override', 'diagnosis_sementara', 'intervensi',
        'catatan_klinis', 'jadwal_followup', 'status',
        'fase_ke', 'status_akhir', 'catatan_akhir'
    ];

    public function getByVictimId(int $victimId, int $faseKe = 0): ?array
    {
        return $this->where('victim_id', $victimId)->where('fase_ke', $faseKe)->first();
    }
}
