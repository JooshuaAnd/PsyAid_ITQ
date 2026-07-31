<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\LongitudinalFollowupModel;
use App\Models\ClinicalActionModel;
use App\Models\ItqResultModel;
use App\Services\AiAssessmentService;

class MonitoringController extends Controller
{
    public function index()
    {
        $psychId = (int) session()->get('user_id');

        $db      = \Config\Database::connect();
        $builder = $db->table('psychologist_assignment');
        $builder->select('
            victims.id as victim_id, victims.nama as victim_nama, victims.nik, victims.umur, victims.jenis_kelamin,
            clinical_action.diagnosis_sementara, clinical_action.intervensi, clinical_action.jadwal_followup,
            itq_result.ptsd_score, itq_result.dso_score, itq_result.final_diagnosis
        ');
        $builder->join('victims', 'victims.id = psychologist_assignment.victim_id');
        $builder->join('clinical_action', 'clinical_action.victim_id = victims.id');
        $builder->join('itq_result', 'itq_result.victim_id = victims.id', 'left');
        $builder->where('psychologist_assignment.psikolog_id', $psychId);

        $builder->orderBy('clinical_action.jadwal_followup', 'ASC');

        $monitoredVictims = $builder->get()->getResultArray();

        $data = [
            'title'            => 'Monitoring & Follow-Up Penyintas — PsyAid',
            'monitoredVictims' => $monitoredVictims,
        ];

        return view('psikolog/MonitoringList', $data);
    }

    public function detail($victimId)
    {
        $db = \Config\Database::connect();
        $victim = $db->table('victims')->where('id', $victimId)->get()->getRowArray();

        if (! $victim) {
            return redirect()->to('/psikolog/monitoring')->with('error', 'Penyintas tidak ditemukan.');
        }

        $clinicalModel = new ClinicalActionModel();
        $clinicalActions = $clinicalModel->where('victim_id', $victimId)->findAll();
        $caByFase = [];
        foreach ($clinicalActions as $ca) $caByFase[$ca['fase_ke']] = $ca;

        $itqModel = new ItqResultModel();
        $itqResults = $itqModel->where('victim_id', $victimId)->findAll();
        $itqByFase = [];
        foreach ($itqResults as $ir) $itqByFase[$ir['fase_ke']] = $ir;

        $aiModel = new \App\Models\AiAssessmentModel();
        $aiAssessments = $aiModel->where('victim_id', $victimId)->findAll();
        $aiByFase = [];
        foreach ($aiAssessments as $ai) $aiByFase[$ai['fase_ke']] = $ai;

        $reviewModel = new \App\Models\PsychologistReviewModel();
        $psychologistReviews = $reviewModel->where('victim_id', $victimId)->findAll();
        $reviewByFase = [];
        foreach ($psychologistReviews as $pr) $reviewByFase[$pr['fase_ke']] = $pr;

        // Final decision (fase_ke = 99)
        $finalDecision = $caByFase[99] ?? null;

        // Fetch Volunteer Screening Data
        $screeningModel = new \App\Models\VolunteerScreeningModel();
        $volunteerScreening = $screeningModel->getByVictimId((int) $victimId);

        $data = [
            'title'              => 'Detail Monitoring & Follow-Up — ' . $victim['nama'],
            'victim'             => $victim,
            'caByFase'           => $caByFase,
            'itqByFase'          => $itqByFase,
            'aiByFase'           => $aiByFase,
            'reviewByFase'       => $reviewByFase,
            'finalDecision'      => $finalDecision,
            'volunteerScreening' => $volunteerScreening,
        ];

        return view('psikolog/MonitoringDetail', $data);
    }

    public function generateAiSummary($victimId)
    {
        $aiService = new AiAssessmentService();
        $result = $aiService->generateFollowUpSummary((int) $victimId);

        if ($result) {
            return $this->response->setJSON(['status' => 'success', 'summary' => $result]);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghasilkan summary AI.']);
    }

    public function storeFinalDecision($victimId)
    {
        $statusAkhir = $this->request->getPost('status_akhir');
        $catatanAkhir = $this->request->getPost('catatan_akhir');

        $clinicalModel = new ClinicalActionModel();
        $existing = $clinicalModel->where('victim_id', $victimId)->where('fase_ke', 99)->first();

        $data = [
            'victim_id' => $victimId,
            'fase_ke' => 99,
            'status_akhir' => $statusAkhir,
            'catatan_akhir' => $catatanAkhir,
        ];

        if ($existing) {
            $clinicalModel->update($existing['id'], $data);
        } else {
            $clinicalModel->insert($data);
        }

        return redirect()->back()->with('success', 'Keputusan akhir berhasil disimpan.');
    }

    public function updateAiSummary($victimId, $faseKe)
    {
        $aiSummary = $this->request->getPost('ai_summary');

        $aiModel = new \App\Models\AiAssessmentModel();
        $existing = $aiModel->where('victim_id', $victimId)->where('fase_ke', $faseKe)->first();

        if ($existing) {
            $aiModel->update($existing['id'], ['ai_summary' => $aiSummary]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'AI Summary berhasil diperbarui.']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Data AI tidak ditemukan.']);
    }
}
