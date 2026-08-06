<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use App\Models\AiAssessmentModel;
use App\Models\DisasterInfoModel;
use App\Models\PsychologicalHistoryModel;
use App\Models\PsychologistReviewModel;
use App\Models\VictimModel;
use App\Models\VolunteerScreeningModel;
use CodeIgniter\Controller;

class PsychologistReviewController extends Controller
{
    /**
     * Display Read-only Summary & Chief Complaint + MSE Form (SEGMEN 11)
     */
    public function show($victimId)
    {
        $faseKe = (int) $this->request->getGet('fase_ke') ?: 0;

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
            return redirect()->to('/psikolog/dashboard')->with('error', 'Penyintas tidak ditemukan.');
        }

        // Fetch all read-only summary data
        $disasterModel = new DisasterInfoModel();
        $psychModel = new PsychologicalHistoryModel();
        $screeningModel = new VolunteerScreeningModel();
        $aiModel = new AiAssessmentModel();
        $reviewModel = new PsychologistReviewModel();

        $disaster = $disasterModel->getByVictimId((int) $victimId);
        $psychHist = $psychModel->getByVictimId((int) $victimId);
        $screening = $screeningModel->getByVictimId((int) $victimId);
        $aiAssessment = $aiModel->where('victim_id', $victimId)->where('fase_ke', $faseKe)->first();
        $review = $reviewModel->getByVictimId((int) $victimId, $faseKe);

        $savedDiagnoses = [];
        if (!empty($psychHist['diagnosis_sebelumnya'])) {
            $decoded = json_decode($psychHist['diagnosis_sebelumnya'], true);
            if (is_array($decoded)) {
                $savedDiagnoses = $decoded;
            }
        }

        $data = [
            'title' => 'Review Klinis Psikolog - ' . $victim['nama'],
            'victim' => $victim,
            'disaster' => $disaster,
            'psychHist' => $psychHist,
            'savedDiagnoses' => $savedDiagnoses,
            'screening' => $screening,
            'aiAssessment' => $aiAssessment,
            'review' => $review,
            'fase_ke' => $faseKe,
        ];

        return view('psikolog/Review', $data);
    }

    /**
     * Save Chief Complaint & Mental Status Examination (MSE)
     */
    public function store($victimId)
    {
        $faseKe = (int) $this->request->getGet('fase_ke') ?: 0;

        $rules = [
            'chief_complaint' => 'required|min_length[5]',
            'mse_appearance' => 'required',
            'mse_behavior' => 'required',
            'mse_speech' => 'required',
            'mse_mood' => 'required',
            'mse_affect' => 'required',
            'mse_thought' => 'required',
            'mse_orientation' => 'required',
            'mse_insight' => 'required',
            'mse_perception' => 'required',
            'risk_assessment' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $reviewModel = new PsychologistReviewModel();
        $existing = $reviewModel->getByVictimId((int) $victimId, $faseKe);

        $data = [
            'victim_id' => (int) $victimId,
            'psikolog_id' => session()->get('user_id') ?? 4,
            'fase_ke' => $faseKe,
            'chief_complaint' => $this->request->getPost('chief_complaint'),
            'mse_appearance' => $this->request->getPost('mse_appearance'),
            'mse_appearance_note' => $this->request->getPost('mse_appearance_note'),
            'mse_behavior' => $this->request->getPost('mse_behavior'),
            'mse_behavior_note' => $this->request->getPost('mse_behavior_note'),
            'mse_speech' => $this->request->getPost('mse_speech'),
            'mse_speech_note' => $this->request->getPost('mse_speech_note'),
            'mse_mood' => $this->request->getPost('mse_mood'),
            'mse_mood_note' => $this->request->getPost('mse_mood_note'),
            'mse_affect' => $this->request->getPost('mse_affect'),
            'mse_affect_note' => $this->request->getPost('mse_affect_note'),
            'mse_thought' => $this->request->getPost('mse_thought'),
            'mse_thought_note' => $this->request->getPost('mse_thought_note'),
            'mse_orientation' => $this->request->getPost('mse_orientation'),
            'mse_orientation_note' => $this->request->getPost('mse_orientation_note'),
            'mse_insight' => $this->request->getPost('mse_insight'),
            'mse_insight_note' => $this->request->getPost('mse_insight_note'),
            'mse_perception' => $this->request->getPost('mse_perception'),
            'mse_perception_note' => $this->request->getPost('mse_perception_note'),
            'risk_assessment' => $this->request->getPost('risk_assessment'),
            'risk_assessment_note' => $this->request->getPost('risk_assessment_note'),
            'reviewed_at' => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $reviewModel->update($existing['id'], $data);
        } else {
            $reviewModel->insert($data);
        }

        return redirect()->to('/itq/form/' . $victimId . '?fase_ke=' . $faseKe)
            ->with('success', 'Hasil Review Chief Complaint & MSE berhasil disimpan. Silakan lanjutkan pengisian Instrumen ITQ.');
    }
}
