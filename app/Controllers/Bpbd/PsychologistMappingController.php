<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use App\Models\PoskoModel;

class PsychologistMappingController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Fetch posko list with assigned psychologists & active workload
        $poskoModel = new PoskoModel();
        $poskos     = $poskoModel->findAll();

        $mappingData = [];

        foreach ($poskos as $p) {
            $pId = (int) $p['id'];

            // Get psychologists for this posko
            $psychologists = $db->table('users')
                ->where('role', 'psikolog')
                ->where('posko_id', $pId)
                ->get()
                ->getResultArray();

            $psychList = [];
            foreach ($psychologists as $psych) {
                $psychId = (int) $psych['id'];

                // Count assigned victims & active unreviewed cases
                $assignedCount = $db->table('psychologist_assignment')
                    ->where('psikolog_id', $psychId)
                    ->countAllResults();

                $unreviewedCount = $db->table('psychologist_assignment')
                    ->join('psychologist_review', 'psychologist_review.victim_id = psychologist_assignment.victim_id', 'left')
                    ->where('psychologist_assignment.psikolog_id', $psychId)
                    ->where('psychologist_review.id IS NULL')
                    ->countAllResults();

                $psychList[] = [
                    'id'               => $psychId,
                    'name'             => $psych['name'],
                    'email'            => $psych['email'],
                    'total_assigned'   => $assignedCount,
                    'active_unreviewed'=> $unreviewedCount,
                ];
            }

            $mappingData[] = [
                'posko'         => $p,
                'psychologists' => $psychList,
            ];
        }

        // Fetch all psychologists in system for mapping assignment modal
        $allPsychologists = $db->table('users')
            ->where('role', 'psikolog')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title'            => 'Mapping Penugasan Psikolog — BPBD Command Center',
            'mappingData'      => $mappingData,
            'allPsychologists' => $allPsychologists,
        ];

        return view('bpbd/PsikologMapping', $data);
    }

    /**
     * Update psychologist assignment for a specific posko
     */
    public function updateMapping($poskoId)
    {
        $db = \Config\Database::connect();
        $poskoModel = new PoskoModel();

        $posko = $poskoModel->find($poskoId);
        if (!$posko) {
            return redirect()->to('/bpbd/psychologist-mapping')->with('error', 'Data Posko Bencana tidak ditemukan.');
        }

        $selectedPsychIds = $this->request->getPost('psychologist_ids') ?? [];
        if (!is_array($selectedPsychIds)) {
            $selectedPsychIds = [];
        }
        $selectedPsychIds = array_map('intval', array_filter($selectedPsychIds));

        // 1. Unassign all psychologists currently assigned to this posko
        $db->table('users')
            ->where('role', 'psikolog')
            ->where('posko_id', (int)$poskoId)
            ->update(['posko_id' => null]);

        // 2. Assign selected psychologists to this posko
        if (!empty($selectedPsychIds)) {
            $db->table('users')
                ->where('role', 'psikolog')
                ->whereIn('id', $selectedPsychIds)
                ->update(['posko_id' => (int)$poskoId]);
        }

        return redirect()->to('/bpbd/psychologist-mapping')
            ->with('success', 'Penugasan tim psikolog untuk posko "' . esc($posko['name']) . '" berhasil diperbarui!');
    }
}
