<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use App\Models\PoskoModel;
use App\Models\ProvinceModel;
use App\Models\RegencyModel;
use App\Models\VictimModel;
use CodeIgniter\Controller;

class CommandCenterController extends Controller
{
    public function index()
    {
        $provinceModel = new ProvinceModel();
        $poskoModel = new PoskoModel();
        $victimModel = new VictimModel();

        $provinces = $provinceModel->orderBy('name', 'ASC')->findAll();
        $jenisBencana = $poskoModel->getDistinctJenisBencana();
        $initialStats = $victimModel->getDashboardStats();
        $poskoList = $this->getFilteredPoskoList();

        $data = [
            'title' => 'BPBD Command Center - PsyAid',
            'provinces' => $provinces,
            'jenisBencana' => $jenisBencana,
            'stats' => $initialStats,
            'poskoList' => $poskoList,
        ];

        return view('bpbd/CommandCenter', $data);
    }

    /**
     * AJAX Endpoint: Get regencies by province ID
     */
    public function getRegencies($provinceId)
    {
        $regencyModel = new RegencyModel();
        $regencies = $regencyModel->getByProvinceId((int) $provinceId);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $regencies,
        ]);
    }

    /**
     * AJAX Endpoint: Get Real-Time Filtered Statistics & Posko Summary
     */
    public function getStats()
    {
        $filters = [
            'province_id' => $this->request->getGet('province_id'),
            'regency_id' => $this->request->getGet('regency_id'),
            'jenis_bencana' => $this->request->getGet('jenis_bencana'),
            'status' => $this->request->getGet('status'),
        ];

        $victimModel = new VictimModel();
        $stats = $victimModel->getDashboardStats($filters);
        $poskoList = $this->getFilteredPoskoList($filters);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $stats,
            'poskoList' => $poskoList,
        ]);
    }

    /**
     * Helper to retrieve posko details, AI risk level breakdown, and priority highlighting
     */
    private function getFilteredPoskoList(array $filters = []): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('posko');
        $builder->select("
            posko.id, posko.name as posko_name, posko.jenis_bencana, posko.status,
            regencies.name as regency_name, provinces.name as province_name,
            COUNT(DISTINCT victims.id) as total_korban,
            COUNT(DISTINCT CASE WHEN volunteer_screening.id IS NOT NULL THEN victims.id END) as sudah_screening,
            COUNT(DISTINCT CASE WHEN ai_assessment.risk_level = 'high' THEN victims.id END) as high_risk_count,
            COUNT(DISTINCT CASE WHEN ai_assessment.risk_level = 'medium' THEN victims.id END) as medium_risk_count,
            COUNT(DISTINCT CASE WHEN ai_assessment.risk_level = 'low' THEN victims.id END) as low_risk_count
        ");
        $builder->join('regencies', 'regencies.id = posko.regency_id');
        $builder->join('provinces', 'provinces.id = regencies.province_id');
        $builder->join('victims', 'victims.posko_id = posko.id', 'left');
        $builder->join('volunteer_screening', 'volunteer_screening.victim_id = victims.id', 'left');
        $builder->join('ai_assessment', 'ai_assessment.victim_id = victims.id', 'left');

        if (!empty($filters['province_id'])) {
            $builder->where('provinces.id', $filters['province_id']);
        }
        if (!empty($filters['regency_id'])) {
            $builder->where('regencies.id', $filters['regency_id']);
        }
        if (!empty($filters['jenis_bencana'])) {
            $builder->where('posko.jenis_bencana', $filters['jenis_bencana']);
        }
        if (!empty($filters['status'])) {
            $builder->where('posko.status', $filters['status']);
        }

        $builder->groupBy([
            'posko.id',
            'posko.name',
            'posko.jenis_bencana',
            'posko.status',
            'regencies.name',
            'provinces.name',
        ]);
        $builder->orderBy('posko.name', 'ASC');

        $list = $builder->get()->getResultArray();

        // Calculate maximum high risk count in current filtered list for priority operational highlight
        $maxHigh = 0;
        foreach ($list as $item) {
            $hCount = (int) $item['high_risk_count'];
            if ($hCount > $maxHigh) {
                $maxHigh = $hCount;
            }
        }

        foreach ($list as &$item) {
            $item['high_risk_count'] = (int) $item['high_risk_count'];
            $item['medium_risk_count'] = (int) $item['medium_risk_count'];
            $item['low_risk_count'] = (int) $item['low_risk_count'];
            $item['total_korban'] = (int) $item['total_korban'];
            $item['sudah_screening'] = (int) $item['sudah_screening'];
            $item['is_highest_priority'] = ($maxHigh > 0 && $item['high_risk_count'] === $maxHigh);
        }

        return $list;
    }
}
