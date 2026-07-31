<?php

namespace App\Models;

use CodeIgniter\Model;

class ItqResultModel extends Model
{
    protected $table            = 'itq_result';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'ptsd_score', 'ptsd_severity', 'ptsd_percentile',
        'ptsd_criteria_met', 'dso_score', 'dso_severity', 'dso_percentile',
        'dso_criteria_met', 'final_diagnosis', 'reviewed_by', 'reviewed_at'
    ];

    public function getByVictimId(int $victimId): ?array
    {
        return $this->where('victim_id', $victimId)->orderBy('reviewed_at', 'DESC')->first();
    }
}
