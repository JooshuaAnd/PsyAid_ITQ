<?php

namespace App\Controllers;

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
        $db      = \Config\Database::connect();
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

        if (! $victim) {
            return redirect()->to('/psikolog/dashboard')->with('error', 'Penyintas tidak ditemukan.');
        }

        // Fetch all read-only summary data
        $disasterModel  = new DisasterInfoModel();
        $psychModel     = new PsychologicalHistoryModel();
        $screeningModel = new VolunteerScreeningModel();
        $aiModel        = new AiAssessmentModel();
        $reviewModel    = new PsychologistReviewModel();

        $disaster     = $disasterModel->getByVictimId((int) $victimId);
        $psychHist    = $psychModel->getByVictimId((int) $victimId);
        $screening    = $screeningModel->getByVictimId((int) $victimId);
        $aiAssessment = $aiModel->where('victim_id', $victimId)->first();
        $review       = $reviewModel->getByVictimId((int) $victimId);

        $savedDiagnoses = [];
        if (! empty($psychHist['diagnosis_sebelumnya'])) {
            $decoded = json_decode($psychHist['diagnosis_sebelumnya'], true);
            if (is_array($decoded)) {
                $savedDiagnoses = $decoded;
            }
        }

        $data = [
            'title'          => 'Review Klinis Psikolog — ' . $victim['nama'],
            'victim'         => $victim,
            'disaster'       => $disaster,
            'psychHist'      => $psychHist,
            'savedDiagnoses' => $savedDiagnoses,
            'screening'      => $screening,
            'aiAssessment'   => $aiAssessment,
            'review'         => $review,
        ];

        return view('psychologist/review', $data);
    }

    /**
     * Save Chief Complaint & Mental Status Examination (MSE)
     */
    public function store($victimId)
    {
        $rules = [
            'chief_complaint' => 'required|min_length[5]',
            'mse_appearance'  => 'required',
            'mse_behavior'    => 'required',
            'mse_speech'      => 'required',
            'mse_mood'        => 'required',
            'mse_affect'      => 'required',
            'mse_thought'     => 'required',
            'mse_orientation' => 'required',
            'mse_insight'     => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $reviewModel = new PsychologistReviewModel();
        $existing    = $reviewModel->getByVictimId((int) $victimId);

        $data = [
            'victim_id'       => (int) $victimId,
            'psikolog_id'     => session()->get('user_id') ?? 4,
            'chief_complaint' => $this->request->getPost('chief_complaint'),
            'mse_appearance'  => $this->request->getPost('mse_appearance'),
            'mse_behavior'    => $this->request->getPost('mse_behavior'),
            'mse_speech'      => $this->request->getPost('mse_speech'),
            'mse_mood'        => $this->request->getPost('mse_mood'),
            'mse_affect'      => $this->request->getPost('mse_affect'),
            'mse_thought'     => $this->request->getPost('mse_thought'),
            'mse_orientation' => $this->request->getPost('mse_orientation'),
            'mse_insight'     => $this->request->getPost('mse_insight'),
            'reviewed_at'     => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $reviewModel->update($existing['id'], $data);
        } else {
            $reviewModel->insert($data);
        }

        return redirect()->to('/itq/form/' . $victimId)
            ->with('success', 'Hasil Review Chief Complaint & MSE berhasil disimpan. Silakan lanjutkan pengisian Instrumen ITQ.');
    }
}
