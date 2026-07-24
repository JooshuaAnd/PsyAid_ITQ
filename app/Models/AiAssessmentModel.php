<?php

namespace App\Models;

use CodeIgniter\Model;

class AiAssessmentModel extends Model
{
    protected $table            = 'ai_assessment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'risk_level', 'confidence', 'clinical_priority',
        'kemungkinan_diagnosis', 'risiko_ptsd_berkembang', 'evidence_sources',
        'ai_summary', 'status', 'generated_at'
    ];
}
