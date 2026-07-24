<?php

namespace App\Models;

use CodeIgniter\Model;

class VolunteerScreeningModel extends Model
{
    protected $table            = 'volunteer_screening';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'mampu_sebut_nama', 'mampu_sebut_lokasi', 'mampu_sebut_tanggal',
        'kontak_mata', 'bicara', 'menangis_terus', 'tampak_panik', 'sulit_ditenangkan',
        'gemetar', 'berteriak_histeris', 'diam_total', 'menghindari_orang',
        'menyebut_ingin_mati', 'mengancam_bunuh_diri', 'melukai_diri', 'agresif',
        'mencari_keluarga', 'sulit_tidur', 'mimpi_buruk', 'tidak_mau_makan',
        'skala_distress', 'catatan_relawan', 'foto_path', 'voice_note_path',
        'video_path', 'dokumen_path', 'relawan_id', 'created_at'
    ];
    protected $useTimestamps    = false;

    public function getByVictimId(int $victimId): ?array
    {
        return $this->where('victim_id', $victimId)->orderBy('created_at', 'DESC')->first();
    }
}
