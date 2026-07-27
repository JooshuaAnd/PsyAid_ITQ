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

        $clinicalModel = new ClinicalActionModel();
        $existing      = $clinicalModel->getByVictimId((int) $victimId);

        $actionData = [
            'victim_id'                  => (int) $victimId,
            'psikolog_id'                => session()->get('user_id') ?? 4,
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

        // Update status in ai_assessment table to 'reviewed'
        $aiModel  = new AiAssessmentModel();
        $existingAi = $aiModel->where('victim_id', $victimId)->first();

        if ($existingAi) {
            $aiData = [
                'status' => 'reviewed',
            ];

            // If psychologist overrode priority, update clinical priority
            if (! $aiApproved && ! empty($priorityOverride)) {
                $aiData['clinical_priority'] = 'Prioritas (Override: ' . $priorityOverride . ')';
                $aiData['risk_level']        = strtolower($priorityOverride);
            }

            $aiModel->update($existingAi['id'], $aiData);
        }

        return redirect()->to('/psikolog/dashboard')
            ->with('success', 'Aksi klinis psikolog berhasil disimpan. Status rekam medis penyintas di seluruh dashboard otomatis ter-update menjadi REVIEWED oleh ' . session()->get('user_name') . '.');
    }
}
