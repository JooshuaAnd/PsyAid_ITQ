<?php

namespace App\Controllers;

use App\Models\PoskoModel;
use CodeIgniter\Controller;

class PsychologistMappingController extends Controller
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

        $data = [
            'title'       => 'Mapping Penugasan Psikolog — PsyAid',
            'mappingData' => $mappingData,
        ];

        return view('psychologist/mapping', $data);
    }
}
