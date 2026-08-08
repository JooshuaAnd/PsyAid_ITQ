<?php

namespace App\Controllers\Relawan;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\VictimModel;

class PoskoController extends BaseController
{
    public function detail($poskoId)
    {
        $role = (string) session()->get('role');
        if ($role === 'relawan') {
            $assignedPoskoId = (int) (session()->get('posko_id') ?? 0);
            if ($assignedPoskoId <= 0) {
                return redirect()->to('/relawan/posko-tidak-tersedia');
            }
            if ((int) $poskoId !== $assignedPoskoId) {
                return redirect()->to('/relawan/posko/' . $assignedPoskoId);
            }
        }

        $db = \Config\Database::connect();
        $builder = $db->table('posko');
        $builder->select('
            posko.*,
            regencies.name as regency_name,
            provinces.name as province_name
        ');
        // A post remains a valid volunteer workspace while its regional
        // metadata is being completed. INNER JOIN previously hid that post and
        // sent volunteers into the BPBD-only command center.
        $builder->join('regencies', 'regencies.id = posko.regency_id', 'left');
        $builder->join('provinces', 'provinces.id = regencies.province_id', 'left');
        $builder->where('posko.id', $poskoId);
        $posko = $builder->get()->getRowArray();

        if (!$posko) {
            return $this->missingPoskoRedirect();
        }

        // Active Personnel (Users) at this Posko
        $userModel = new UserModel();
        $personnel = $userModel->where('posko_id', $poskoId)->findAll();

        // Calculate summary stats for this Posko
        $victimModel = new VictimModel();
        $stats = $victimModel->getDashboardStats(['posko_id' => $poskoId]);

        $req = service('request');

        // Search & Filter parameters for Victims table
        $searchFilters = [
            'keyword' => $req->getGet('q'),
            'screening_status' => $req->getGet('screening_status'),
            'risk_level' => $req->getGet('risk_level'),
        ];

        // Fetch Victims at this Posko
        $victims = $victimModel->getVictimsByPosko((int) $poskoId, $searchFilters);

        $data = [
            'title' => 'Dashboard Posko - ' . $posko['name'],
            'posko' => $posko,
            'personnel' => $personnel,
            'stats' => $stats,
            'victims' => $victims,
            'searchFilters' => $searchFilters,
        ];

        return view('relawan/PoskoDetail', $data);
    }

    public function manajemenPenyintas()
    {
        $poskoId = session()->get('posko_id') ?? 1;
        $db = \Config\Database::connect();
        $builder = $db->table('posko');
        $builder->select('
            posko.*,
            regencies.name as regency_name,
            provinces.name as province_name
        ');
        $builder->join('regencies', 'regencies.id = posko.regency_id', 'left');
        $builder->join('provinces', 'provinces.id = regencies.province_id', 'left');
        $builder->where('posko.id', $poskoId);
        $posko = $builder->get()->getRowArray();

        if (!$posko && (string) session()->get('role') === 'relawan') {
            return redirect()->to('/relawan/posko-tidak-tersedia');
        }

        $victimModel = new VictimModel();
        $stats = $victimModel->getDashboardStats(['posko_id' => $poskoId]);

        $req = service('request');

        $searchFilters = [
            'keyword' => $req->getGet('q'),
            'screening_status' => $req->getGet('screening_status'),
            'risk_level' => $req->getGet('risk_level'),
        ];

        $victims = $victimModel->getVictimsByPosko((int) $poskoId, $searchFilters);

        $data = [
            'title' => 'Manajemen Data Penyintas — PsyAid',
            'posko' => $posko ?: ['id' => 1, 'name' => 'Posko Utama'],
            'stats' => $stats,
            'victims' => $victims,
            'searchFilters' => $searchFilters,
        ];

        return view('relawan/ManajemenDataPenyintas', $data);
    }

    private function missingPoskoRedirect()
    {
        return match ((string) session()->get('role')) {
            'relawan' => redirect()->to('/relawan/posko-tidak-tersedia')
                ->with('error', 'Posko yang terhubung ke akun ini belum tersedia.'),
            'psikolog' => redirect()->to('/psikolog/dashboard')
                ->with('error', 'Posko tidak ditemukan.'),
            default => redirect()->to('/command-center')
                ->with('error', 'Posko tidak ditemukan.'),
        };
    }
}
