<?php

namespace App\Models;

use CodeIgniter\Model;

class RegencyModel extends Model
{
    protected $table            = 'regencies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['province_id', 'name'];

    /**
     * Fetch regencies for a specific province.
     * Uses static JSON asset for 0ms ultra-fast response, with DB fallback.
     */
    public function getByProvinceId(int $provinceId): array
    {
        if ($provinceId <= 0) {
            return [];
        }

        $allGrouped = $this->getAllGroupedByProvince();
        if (isset($allGrouped[$provinceId])) {
            return $allGrouped[$provinceId];
        }
        if (isset($allGrouped[(string) $provinceId])) {
            return $allGrouped[(string) $provinceId];
        }

        return $this->select('id, province_id, name')
            ->where('province_id', $provinceId)
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    /**
     * Fetch all regencies grouped by province_id using static JSON file asset
     */
    public function getAllGroupedByProvince(): array
    {
        $jsonPath = FCPATH . 'data/regencies_grouped.json';
        if (file_exists($jsonPath)) {
            $content = @file_get_contents($jsonPath);
            if ($content !== false) {
                $decoded = json_decode($content, true);
                if (is_array($decoded) && !empty($decoded)) {
                    return $decoded;
                }
            }
        }

        // Fallback to database query if static file is missing
        $all = $this->select('id, province_id, name')
            ->orderBy('name', 'ASC')
            ->findAll();

        $grouped = [];
        foreach ($all as $reg) {
            $grouped[$reg['province_id']][] = [
                'id'   => (int) $reg['id'],
                'name' => $reg['name'],
            ];
        }

        return $grouped;
    }
}
