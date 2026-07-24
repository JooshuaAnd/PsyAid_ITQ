<?php

namespace App\Models;

use CodeIgniter\Model;

class PsychologicalHistoryModel extends Model
{
    protected $table            = 'psychological_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'pernah_konsultasi', 'pernah_dirawat_psikiater',
        'diagnosis_sebelumnya', 'sedang_konsumsi_obat', 'nama_obat',
        'dosis', 'dokter', 'riwayat_percobaan_bunuh_diri',
        'riwayat_melukai_diri', 'riwayat_napza', 'riwayat_penyakit_kronis',
        'keterangan_penyakit_kronis'
    ];

    public function getByVictimId(int $victimId): ?array
    {
        return $this->where('victim_id', $victimId)->first();
    }
}
