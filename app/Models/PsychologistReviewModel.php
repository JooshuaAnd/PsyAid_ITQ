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
        'mse_orientation', 'mse_insight', 'reviewed_at',
        'mse_appearance_note', 'mse_behavior_note', 'mse_speech_note', 
        'mse_mood_note', 'mse_affect_note', 'mse_thought_note', 
        'mse_perception_note', 'risk_assessment', 'risk_assessment_note', 'fase_ke'
    ];

    public function getByVictimId(int $victimId, int $faseKe = 0): ?array
    {
        return $this->where('victim_id', $victimId)->where('fase_ke', $faseKe)->first();
    }
}
