<?php

namespace App\Controllers\Bpbd;

use CodeIgniter\Controller;
use App\Models\ProvinceModel;
use App\Models\PoskoModel;
use App\Models\RegencyModel;
use App\Models\VictimModel;

class DashboardBPBDController extends Controller
{
    public function index()
    {
        $provinceModel = new ProvinceModel();
        $poskoModel = new PoskoModel();
        $victimModel = new VictimModel();

        $provinces = $provinceModel->orderBy('name', 'ASC')->findAll();
        $jenisBencana = $poskoModel->getDistinctJenisBencana();
        $stats = $victimModel->getDashboardStats();
        $poskoList = $this->getFilteredPoskoList();

        // Resolve highest priority posko (posko with highest high_risk_count)
        $highestPriorityPosko = null;
        foreach ($poskoList as $posko) {
            if ($posko['is_highest_priority']) {
                $highestPriorityPosko = $posko;
                break;
            }
        }
        if (!$highestPriorityPosko && !empty($poskoList)) {
            $highestPriorityPosko = $poskoList[0];
        }

        $data = [
            'title' => 'Dashboard BPBD - Executive Summary',
            'provinces' => $provinces,
            'jenisBencana' => $jenisBencana,
            'stats' => $stats,
            'poskoList' => $poskoList,
            'highestPriorityPosko' => $highestPriorityPosko,
        ];

        return view('bpbd/DashboardBPBD', $data);
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
