<?php

namespace App\Models;

use CodeIgniter\Model;

class VictimModel extends Model
{
    protected $table            = 'victims';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'posko_id', 'nama', 'jenis_kelamin', 'umur', 'nik',
        'no_hp_keluarga', 'alamat', 'tanggal_datang', 'jam_datang',
        'ditemukan_oleh_relawan_id'
    ];
    protected $useTimestamps    = true;

    /**
     * Calculate Real-time Dashboard Statistics for BPBD Command Center
     */
    public function getDashboardStats(array $filters = []): array
    {
        // 1. Victims & Screening & AI Assessment Stats
        $builder = $this->db->table('victims');
        $builder->select("
            COUNT(DISTINCT victims.id) as total_korban,
            COUNT(DISTINCT CASE WHEN volunteer_screening.id IS NOT NULL THEN victims.id END) as sudah_screening,
            COUNT(DISTINCT CASE WHEN volunteer_screening.id IS NULL THEN victims.id END) as belum_screening,
            COUNT(DISTINCT CASE WHEN ai_assessment.risk_level = 'high' THEN victims.id END) as risk_high,
            COUNT(DISTINCT CASE WHEN ai_assessment.risk_level = 'medium' THEN victims.id END) as risk_medium,
            COUNT(DISTINCT CASE WHEN ai_assessment.risk_level = 'low' THEN victims.id END) as risk_low
        ");
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('regencies', 'regencies.id = posko.regency_id');
        $builder->join('provinces', 'provinces.id = regencies.province_id');
        $builder->join('volunteer_screening', 'volunteer_screening.victim_id = victims.id', 'left');
        $builder->join('ai_assessment', 'ai_assessment.victim_id = victims.id', 'left');

        if (! empty($filters['posko_id'])) {
            $builder->where('posko.id', $filters['posko_id']);
        }
        if (! empty($filters['province_id'])) {
            $builder->where('provinces.id', $filters['province_id']);
        }
        if (! empty($filters['regency_id'])) {
            $builder->where('regencies.id', $filters['regency_id']);
        }
        if (! empty($filters['jenis_bencana'])) {
            $builder->where('posko.jenis_bencana', $filters['jenis_bencana']);
        }
        if (! empty($filters['status'])) {
            $builder->where('posko.status', $filters['status']);
        }

        $victimStats = $builder->get()->getRowArray();

        // 2. Active Personnel Stats (Users)
        $userBuilder = $this->db->table('users');
        $userBuilder->select("
            COUNT(DISTINCT CASE WHEN users.role = 'relawan' THEN users.id END) as jumlah_relawan,
            COUNT(DISTINCT CASE WHEN users.role = 'psikolog' THEN users.id END) as jumlah_psikolog
        ");
        $userBuilder->join('posko', 'posko.id = users.posko_id', 'left');
        $userBuilder->join('regencies', 'regencies.id = posko.regency_id', 'left');
        $userBuilder->join('provinces', 'provinces.id = regencies.province_id', 'left');

        if (! empty($filters['posko_id'])) {
            $userBuilder->where('posko.id', $filters['posko_id']);
        }
        if (! empty($filters['province_id'])) {
            $userBuilder->where('provinces.id', $filters['province_id']);
        }
        if (! empty($filters['regency_id'])) {
            $userBuilder->where('regencies.id', $filters['regency_id']);
        }
        if (! empty($filters['jenis_bencana'])) {
            $userBuilder->where('posko.jenis_bencana', $filters['jenis_bencana']);
        }
        if (! empty($filters['status'])) {
            $userBuilder->where('posko.status', $filters['status']);
        }

        $userStats = $userBuilder->get()->getRowArray();

        // Combine stats
        return [
            'total_korban'    => (int) ($victimStats['total_korban'] ?? 0),
            'sudah_screening' => (int) ($victimStats['sudah_screening'] ?? 0),
            'belum_screening' => (int) ($victimStats['belum_screening'] ?? 0),
            'risk_high'       => (int) ($victimStats['risk_high'] ?? 0),
            'risk_medium'     => (int) ($victimStats['risk_medium'] ?? 0),
            'risk_low'        => (int) ($victimStats['risk_low'] ?? 0),
            'jumlah_relawan'  => (int) ($userStats['jumlah_relawan'] ?? 0),
            'jumlah_psikolog' => (int) ($userStats['jumlah_psikolog'] ?? 0),
        ];
    }

    /**
     * Retrieve Victims list at a specific Posko with screening, AI risk level, and assignment status
     */
    public function getVictimsByPosko(int $poskoId, array $searchFilters = []): array
    {
        $builder = $this->db->table('victims');
        $builder->select('
            victims.*,
            volunteer_screening.id as screening_id,
            volunteer_screening.skala_distress,
            volunteer_screening.created_at as screening_at,
            ai_assessment.risk_level,
            ai_assessment.confidence,
            ai_assessment.clinical_priority,
            ai_assessment.status as ai_status,
            psychologist_assignment.psikolog_id,
            psychologist_assignment.assigned_at,
            psikolog_user.name as psikolog_name
        ');
        $builder->join('volunteer_screening', 'volunteer_screening.victim_id = victims.id', 'left');
        $builder->join('ai_assessment', 'ai_assessment.victim_id = victims.id', 'left');
        $builder->join('psychologist_assignment', 'psychologist_assignment.victim_id = victims.id', 'left');
        $builder->join('users as psikolog_user', 'psikolog_user.id = psychologist_assignment.psikolog_id', 'left');

        $builder->where('victims.posko_id', $poskoId);

        if (! empty($searchFilters['keyword'])) {
            $kw = $searchFilters['keyword'];
            $builder->groupStart()
                    ->like('victims.nama', $kw)
                    ->orLike('victims.nik', $kw)
                    ->groupEnd();
        }

        if (! empty($searchFilters['screening_status'])) {
            if ($searchFilters['screening_status'] === 'sudah') {
                $builder->where('volunteer_screening.id IS NOT NULL');
            } elseif ($searchFilters['screening_status'] === 'belum') {
                $builder->where('volunteer_screening.id IS NULL');
            }
        }

        if (! empty($searchFilters['risk_level'])) {
            $builder->where('ai_assessment.risk_level', $searchFilters['risk_level']);
        }

        // Order strictly by newest arrival date time
        $builder->orderBy('victims.tanggal_datang', 'DESC');
        $builder->orderBy('victims.jam_datang', 'DESC');
        $builder->orderBy('victims.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }
}
