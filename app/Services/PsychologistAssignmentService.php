<?php

namespace App\Services;

use App\Models\PsychologistAssignmentModel;
use App\Models\UserModel;
use App\Models\VictimModel;

class PsychologistAssignmentService
{
    /**
     * Auto-assign psychologist to victim based on minimum active workload (Load Balancing)
     */
    public function autoAssign(int $victimId): ?array
    {
        $victimModel = new VictimModel();
        $victim      = $victimModel->find($victimId);

        if (! $victim) {
            return null;
        }

        $poskoId = (int) $victim['posko_id'];

        // 1. Find psychologists assigned to the same posko
        $userModel = new UserModel();
        $psychologists = $userModel->where('role', 'psikolog')
                                   ->where('posko_id', $poskoId)
                                   ->findAll();

        // Fallback: If no psychologist assigned to this specific posko, get any psychologist
        if (empty($psychologists)) {
            $psychologists = $userModel->where('role', 'psikolog')->findAll();
        }

        if (empty($psychologists)) {
            return null; // No psychologist available in database
        }

        // 2. Count active workload (unreviewed cases) for each psychologist
        $db = \Config\Database::connect();
        $psychWorkload = [];

        foreach ($psychologists as $psych) {
            $pId = (int) $psych['id'];
            $countQuery = $db->table('psychologist_assignment')
                ->join('psychologist_review', 'psychologist_review.victim_id = psychologist_assignment.victim_id', 'left')
                ->where('psychologist_assignment.psikolog_id', $pId)
                ->where('psychologist_review.id IS NULL')
                ->countAllResults();

            $psychWorkload[$pId] = [
                'user'     => $psych,
                'workload' => $countQuery,
            ];
        }

        // 3. Pick psychologist with minimum workload
        uasort($psychWorkload, function ($a, $b) {
            return $a['workload'] <=> $b['workload'];
        });

        $chosenPsychId = array_key_first($psychWorkload);
        $chosenData    = $psychWorkload[$chosenPsychId];
        $currentLoad   = $chosenData['workload'];

        // 4. Save/Update assignment
        $assignModel = new PsychologistAssignmentModel();
        $existing    = $assignModel->where('victim_id', $victimId)->first();

        $data = [
            'victim_id'                => $victimId,
            'psikolog_id'              => $chosenPsychId,
            'assigned_at'              => date('Y-m-d H:i:s'),
            'jumlah_kasus_saat_assign' => $currentLoad,
        ];

        if ($existing) {
            $assignModel->update($existing['id'], $data);
            $assignmentId = $existing['id'];
        } else {
            $assignmentId = $assignModel->insert($data);
        }

        return array_merge($data, [
            'id'            => $assignmentId,
            'psikolog_name' => $chosenData['user']['name'],
        ]);
    }
}
