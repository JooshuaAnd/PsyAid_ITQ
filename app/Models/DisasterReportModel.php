<?php

namespace App\Models;

use CodeIgniter\Model;

class DisasterReportModel extends Model
{
    protected $table            = 'disaster_reports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'ticket_code',
        'nama',
        'whatsapp',
        'jenis_bencana',
        'lokasi_bencana',
        'tanggal_bencana',
        'status_berlangsung',
        'skala_keparahan',
        'catatan_tambahan',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
