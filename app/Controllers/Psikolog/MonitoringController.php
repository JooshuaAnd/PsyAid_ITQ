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

        $db = \Config\Database::connect();

        // Satu penyintas memiliki satu clinical action dan hasil ITQ pada setiap fase.
        // Ranking dilakukan sebelum join agar fase-fase tersebut tidak membentuk
        // perkalian baris (contoh: 2 clinical action x 2 hasil ITQ = 4 baris).
        $clinicalProgress = $db->table('clinical_action ca_progress')
            ->select('ca_progress.*, ROW_NUMBER() OVER (
                PARTITION BY ca_progress.victim_id
                ORDER BY ca_progress.fase_ke DESC, ca_progress.id DESC
            ) AS progress_row', false)
            ->where('ca_progress.fase_ke !=', 99);

        $itqProgress = $db->table('itq_result ir_progress')
            ->select('ir_progress.*, ROW_NUMBER() OVER (
                PARTITION BY ir_progress.victim_id, ir_progress.fase_ke
                ORDER BY ir_progress.reviewed_at DESC, ir_progress.id DESC
            ) AS progress_row', false);

        $rankedVictims = $db->table('psychologist_assignment pa')
            ->select('pd.id as victim_id, pd.nama as victim_nama, pd.nik, pd.umur, pd.jenis_kelamin,
                latest_ca.fase_ke, latest_ca.diagnosis_sementara, latest_ca.intervensi, latest_ca.jadwal_followup,
                latest_itq.ptsd_score, latest_itq.dso_score, latest_itq.final_diagnosis,
                ROW_NUMBER() OVER (
                    PARTITION BY COALESCE(NULLIF(TRIM(pd.nik), \'\'), CONCAT(\'__victim_\', pd.id))
                    ORDER BY latest_ca.fase_ke DESC, latest_ca.id DESC, pd.id DESC, pa.id DESC
                ) AS nik_row', false)
            ->join('victims pd', 'pd.id = pa.victim_id')
            ->join(
                '(' . $clinicalProgress->getCompiledSelect() . ') latest_ca',
                'latest_ca.victim_id = pd.id AND latest_ca.progress_row = 1',
                'inner',
                false
            )
            ->join(
                '(' . $itqProgress->getCompiledSelect() . ') latest_itq',
                'latest_itq.victim_id = pd.id
                    AND latest_itq.fase_ke = latest_ca.fase_ke
                    AND latest_itq.progress_row = 1',
                'left',
                false
            )
            ->where('pa.psikolog_id', $psychId);

        $monitoredVictims = $db->newQuery()
            ->select('victim_id, victim_nama, nik, umur, jenis_kelamin, fase_ke,
                diagnosis_sementara, intervensi, jadwal_followup,
                ptsd_score, dso_score, final_diagnosis')
            ->fromSubquery($rankedVictims, 'monitoring_progress')
            ->where('nik_row', 1)
            ->orderBy('jadwal_followup', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Monitoring & Follow-Up Penyintas - PsyAid',
            'monitoredVictims' => $monitoredVictims,
        ];

        return view('psikolog/MonitoringList', $data);
    }

    public function detail($victimId)
    {
        $db = \Config\Database::connect();
        $victim = $db->table('victims')->where('id', $victimId)->get()->getRowArray();

        if (!$victim) {
            return redirect()->to('/psikolog/monitoring')->with('error', 'Penyintas tidak ditemukan.');
        }

        $clinicalModel = new ClinicalActionModel();
        $clinicalActions = $clinicalModel->where('victim_id', $victimId)->findAll();
        $caByFase = [];
        foreach ($clinicalActions as $ca)
            $caByFase[$ca['fase_ke']] = $ca;

        $itqModel = new ItqResultModel();
        $itqResults = $itqModel->where('victim_id', $victimId)->findAll();
        $itqByFase = [];
        foreach ($itqResults as $ir)
            $itqByFase[$ir['fase_ke']] = $ir;

        $aiModel = new \App\Models\AiAssessmentModel();
        $aiAssessments = $aiModel->where('victim_id', $victimId)->findAll();
        $aiByFase = [];
        foreach ($aiAssessments as $ai)
            $aiByFase[$ai['fase_ke']] = $ai;

        $reviewModel = new \App\Models\PsychologistReviewModel();
        $psychologistReviews = $reviewModel->where('victim_id', $victimId)->findAll();
        $reviewByFase = [];
        foreach ($psychologistReviews as $pr)
            $reviewByFase[$pr['fase_ke']] = $pr;

        // Final decision (fase_ke = 99)
        $finalDecision = $caByFase[99] ?? null;

        // Fetch Volunteer Screening Data
        $screeningModel = new \App\Models\VolunteerScreeningModel();
        $volunteerScreening = $screeningModel->getByVictimId((int) $victimId);

        $data = [
            'title' => 'Detail Monitoring & Follow-Up - ' . $victim['nama'],
            'victim' => $victim,
            'caByFase' => $caByFase,
            'itqByFase' => $itqByFase,
            'aiByFase' => $aiByFase,
            'reviewByFase' => $reviewByFase,
            'finalDecision' => $finalDecision,
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
