<?php

namespace App\Models;

use CodeIgniter\Model;

class PsychologistReviewModel extends Model
{
    protected $table            = 'psychologist_review';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'psikolog_id', 'chief_complaint',
        'mse_appearance', 'mse_behavior', 'mse_speech',
        'mse_mood', 'mse_affect', 'mse_thought',
        'mse_orientation', 'mse_insight', 'reviewed_at'
    ];

    public function getByVictimId(int $victimId): ?array
    {
        return $this->where('victim_id', $victimId)->orderBy('reviewed_at', 'DESC')->first();
    }
}
