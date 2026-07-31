<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use App\Models\AiAssessmentModel;
use App\Models\ClinicalActionModel;
use App\Models\VictimModel;
use CodeIgniter\Controller;

class ClinicalActionController extends Controller
{
    /**
     * Store Final Clinical Decision & Update Record Status to Reviewed (SEGMEN 15)
     */
    public function save($victimId)
    {
        $victimModel = new VictimModel();
        $victim      = $victimModel->find($victimId);

        if (! $victim) {
            return redirect()->to('/psikolog/dashboard')->with('error', 'Penyintas tidak ditemukan.');
        }

        $rules = [
            'diagnosis_sementara' => 'required|min_length[3]',
            'intervensi'          => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $aiApproved       = $this->request->getPost('ai_recommendation_approved') ? true : false;
        $priorityOverride = $this->request->getPost('priority_override') ?: null;

        $faseKe = (int) $this->request->getGet('fase_ke') ?: 0;

        $clinicalModel = new ClinicalActionModel();
        $existing      = $clinicalModel->getByVictimId((int) $victimId, $faseKe);

        $actionData = [
            'victim_id'                  => (int) $victimId,
            'psikolog_id'                => session()->get('user_id') ?? 4,
            'fase_ke'                    => $faseKe,
            'ai_recommendation_approved' => $aiApproved,
            'priority_override'          => $aiApproved ? null : $priorityOverride,
            'diagnosis_sementara'        => $this->request->getPost('diagnosis_sementara'),
            'intervensi'                 => $this->request->getPost('intervensi'),
            'catatan_klinis'             => $this->request->getPost('catatan_klinis') ?: null,
            'jadwal_followup'            => $this->request->getPost('jadwal_followup') ?: null,
            'status'                     => 'reviewed',
        ];

        if ($existing) {
            $clinicalModel->update($existing['id'], $actionData);
        } else {
            $clinicalModel->insert($actionData);
        }

        // Trigger AI Generation for Psychologist Review (Phase 0, 1, 2, 3...)
        $aiService = new \App\Services\AiAssessmentService();
        $aiService->calculateRisk((int) $victimId, $faseKe);

        return redirect()->to('/psikolog/monitoring/detail/' . $victimId)
            ->with('success', 'Aksi klinis psikolog berhasil disimpan. Hasil Analisis AI terbaru telah digenerate.');
    }
}
