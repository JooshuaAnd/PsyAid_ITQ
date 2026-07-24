<?php

namespace App\Models;

use CodeIgniter\Model;

class LongitudinalFollowupModel extends Model
{
    protected $table            = 'longitudinal_followup';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['victim_id', 'hari', 'ptsd_score', 'dso_score', 'recorded_at'];

    public function getFollowupsByVictim(int $victimId): array
    {
        return $this->where('victim_id', $victimId)->orderBy('recorded_at', 'ASC')->findAll();
    }
}
