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
        $clinicalAction = $clinicalModel->getByVictimId((int) $victimId);

        $itqModel = new ItqResultModel();
        $itqResult = $itqModel->getByVictimId((int) $victimId);

        $followupModel = new LongitudinalFollowupModel();
        $followups = $followupModel->getFollowupsByVictim((int) $victimId);

        // Organize follow-ups by Follow up Ke (1, 2, 3)
        $organizedFollowups = [
            1 => null,
            2 => null,
            3 => null,
        ];

        foreach ($followups as $f) {
            if ($f['hari'] == 7) $organizedFollowups[1] = $f;
            else if ($f['hari'] == 14) $organizedFollowups[2] = $f;
            else if ($f['hari'] == 30) $organizedFollowups[3] = $f;
        }

        $data = [
            'title'              => 'Detail Monitoring & Follow-Up — ' . $victim['nama'],
            'victim'             => $victim,
            'clinicalAction'     => $clinicalAction,
            'itqResult'          => $itqResult,
            'organizedFollowups' => $organizedFollowups,
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
}
