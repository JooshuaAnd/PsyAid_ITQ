<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class PsikologController extends Controller
{
    public function index()
    {
        $psychId = (int) session()->get('user_id');

        $db      = \Config\Database::connect();
        $builder = $db->table('psychologist_assignment');
        $builder->select('
            psychologist_assignment.assigned_at,
            psychologist_assignment.jumlah_kasus_saat_assign,
            victims.id as victim_id, victims.nama as victim_nama, victims.nik, victims.umur, victims.jenis_kelamin,
            posko.name as posko_name,
            ai_assessment.risk_level, ai_assessment.clinical_priority, ai_assessment.status as ai_status,
            psychologist_review.id as review_id, psychologist_review.reviewed_at,
            itq_answers.id as itq_id
        ');
        $builder->join('victims', 'victims.id = psychologist_assignment.victim_id');
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('ai_assessment', 'ai_assessment.victim_id = victims.id', 'left');
        $builder->join('psychologist_review', 'psychologist_review.victim_id = victims.id', 'left');
        $builder->join('itq_answers', 'itq_answers.victim_id = victims.id', 'left');
        $builder->where('psychologist_assignment.psikolog_id', $psychId);

        // Order High Risk first, then unreviewed cases
        $builder->orderBy("
            CASE 
                WHEN ai_assessment.risk_level = 'high' THEN 1 
                WHEN ai_assessment.risk_level = 'medium' THEN 2 
                ELSE 3 
            END", "ASC", false);
        $builder->orderBy('psychologist_assignment.assigned_at', 'DESC');

        $assignedVictims = $builder->get()->getResultArray();

        $data = [
            'title'           => 'Dashboard Clinical Workspace Psikolog — PsyAid',
            'assignedVictims' => $assignedVictims,
        ];

        return view('psikolog/Dashboard', $data);
    }
}
