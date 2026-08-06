<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\DisasterInfoModel;
use App\Models\PsychologicalHistoryModel;
use App\Models\VolunteerScreeningModel;
use App\Models\AiAssessmentModel;

class AssessmentHistoryController extends Controller
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
            itq_answers.id as itq_id
        ');
        $builder->join('victims', 'victims.id = psychologist_assignment.victim_id');
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('ai_assessment', 'ai_assessment.victim_id = victims.id', 'left');
        $builder->join('psychologist_review', 'psychologist_review.victim_id = victims.id', 'left');
        $builder->join('itq_answers', 'itq_answers.victim_id = victims.id', 'left');
        $builder->where('psychologist_assignment.psikolog_id', $psychId);

        // Sort by Penyintas (Alphabetical)
        $builder->orderBy('victims.nama', 'ASC');

        $assignedVictims = $builder->get()->getResultArray();

        $data = [
            'title' => 'Detail Data Assessment Penyintas - PsyAid',
            'assignedVictims' => $assignedVictims,
        ];

        return view('psikolog/AssessmentList', $data);
    }

    public function detail($victimId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('victims');
        $builder->select('
            victims.*,
            posko.name as posko_name, posko.jenis_bencana as posko_bencana,
            regencies.name as regency_name, provinces.name as province_name
        ');
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('regencies', 'regencies.id = posko.regency_id');
        $builder->join('provinces', 'provinces.id = regencies.province_id');
        $builder->where('victims.id', $victimId);
        $victim = $builder->get()->getRowArray();

        if (!$victim) {
            return redirect()->to('/psikolog/assessment-history')->with('error', 'Penyintas tidak ditemukan.');
        }

        $disasterModel = new DisasterInfoModel();
        $psychModel = new PsychologicalHistoryModel();
        $screeningModel = new VolunteerScreeningModel();
        $aiModel = new AiAssessmentModel();

        $disaster = $disasterModel->getByVictimId((int) $victimId);
        $psychHist = $psychModel->getByVictimId((int) $victimId);
        $screening = $screeningModel->getByVictimId((int) $victimId);
        $aiAssessment = $aiModel->where('victim_id', $victimId)->first();

        $savedDiagnoses = [];
        if (!empty($psychHist['diagnosis_sebelumnya'])) {
            $decoded = json_decode($psychHist['diagnosis_sebelumnya'], true);
            if (is_array($decoded)) {
                $savedDiagnoses = $decoded;
            }
        }

        // Add ITQ results if any
        $itqAnswers = $db->table('itq_answers')->where('victim_id', $victimId)->get()->getRowArray();

        $data = [
            'title' => 'Assessment History - ' . $victim['nama'],
            'victim' => $victim,
            'disaster' => $disaster,
            'psychHist' => $psychHist,
            'savedDiagnoses' => $savedDiagnoses,
            'screening' => $screening,
            'aiAssessment' => $aiAssessment,
            'itqAnswers' => $itqAnswers
        ];

        return view('psikolog/AssessmentDetail', $data);
    }
}
