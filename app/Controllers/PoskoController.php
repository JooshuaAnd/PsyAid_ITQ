<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VictimModel;
use CodeIgniter\Controller;

class PoskoController extends Controller
{
    public function detail($poskoId)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('posko');
        $builder->select('
            posko.*,
            regencies.name as regency_name,
            provinces.name as province_name
        ');
        $builder->join('regencies', 'regencies.id = posko.regency_id');
        $builder->join('provinces', 'provinces.id = regencies.province_id');
        $builder->where('posko.id', $poskoId);
        $posko = $builder->get()->getRowArray();

        if (! $posko) {
            return redirect()->to('/command-center')->with('error', 'Posko tidak ditemukan.');
        }

        // Active Personnel (Users) at this Posko
        $userModel = new UserModel();
        $personnel = $userModel->where('posko_id', $poskoId)->findAll();

        // Calculate summary stats for this Posko
        $victimModel = new VictimModel();
        $stats       = $victimModel->getDashboardStats(['posko_id' => $poskoId]);

        $req = service('request');

        // Search & Filter parameters for Victims table
        $searchFilters = [
            'keyword'          => $req->getGet('q'),
            'screening_status' => $req->getGet('screening_status'),
            'risk_level'       => $req->getGet('risk_level'),
        ];

        // Fetch Victims at this Posko
        $victims = $victimModel->getVictimsByPosko((int) $poskoId, $searchFilters);

        $data = [
            'title'         => 'Dashboard Posko — ' . $posko['name'],
            'posko'         => $posko,
            'personnel'     => $personnel,
            'stats'         => $stats,
            'victims'       => $victims,
            'searchFilters' => $searchFilters,
        ];

        return view('posko/detail', $data);
    }
}
