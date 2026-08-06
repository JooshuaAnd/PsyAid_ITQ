<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class PsikologController extends Controller
{
    public function index()
    {
        $psychId = (int) session()->get('user_id');

        $db = \Config\Database::connect();
        $builder = $db->table('psychologist_assignment');
        $builder->select('
            psychologist_assignment.assigned_at,
            psychologist_assignment.jumlah_kasus_saat_assign,
            victims.id as victim_id, victims.nama as victim_nama, victims.nik, victims.umur, victims.jenis_kelamin, victims.posko_id,
            posko.name as posko_name,
            ai_assessment.risk_level, ai_assessment.clinical_priority, ai_assessment.status as ai_status,
            psychologist_review.id as review_id, psychologist_review.reviewed_at,
            clinical_action.id as clinical_action_id,
            itq_answers.id as itq_id
        ');
        $builder->join('victims', 'victims.id = psychologist_assignment.victim_id');
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('ai_assessment', 'ai_assessment.victim_id = victims.id', 'left');
        $builder->join('psychologist_review', 'psychologist_review.victim_id = victims.id', 'left');
        $builder->join('clinical_action', 'clinical_action.victim_id = victims.id', 'left');
        $builder->join('itq_answers', 'itq_answers.victim_id = victims.id', 'left');
        $builder->where('psychologist_assignment.psikolog_id', $psychId);

        // Sort by Penyintas (Alphabetical)
        $builder->orderBy('victims.nama', 'ASC');

        $assignedVictims = $builder->get()->getResultArray();

        // psychologist_assignment menyimpan mapping penugasan yang sedang berlaku.
        // Hitung penyintas langsung dari mapping tersebut agar record progres pada
        // tabel assessment tidak menggandakan total penugasan.
        $activeAssignment = $db->table('psychologist_assignment pa')
            ->select("COUNT(DISTINCT COALESCE(
                NULLIF(TRIM(victims.nik), ''),
                CONCAT('__victim_', victims.id)
            )) AS total", false)
            ->join('victims', 'victims.id = pa.victim_id')
            ->where('pa.psikolog_id', $psychId)
            ->get()
            ->getRowArray();

        $activeAssignmentCount = (int) ($activeAssignment['total'] ?? 0);

        // Fetch active personnel for assigned poskos
        $poskoIds = array_filter(array_unique(array_column($assignedVictims, 'posko_id')));
        $userPoskoId = session()->get('posko_id');
        if ($userPoskoId) {
            $poskoIds[] = $userPoskoId;
            $poskoIds = array_filter(array_unique($poskoIds));
        }

        $userModel = new \App\Models\UserModel();
        if (!empty($poskoIds)) {
            $personnel = $userModel->whereIn('posko_id', $poskoIds)->findAll();
        } else {
            $personnel = $userModel->findAll();
        }

        $data = [
            'title' => 'Dashboard Clinical Workspace Psikolog - PsyAid',
            'assignedVictims' => $assignedVictims,
            'activeAssignmentCount' => $activeAssignmentCount,
            'personnel' => $personnel,
        ];

        return view('psikolog/Dashboard', $data);
    }
}
