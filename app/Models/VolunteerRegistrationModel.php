<?php

namespace App\Models;

use CodeIgniter\Model;

class VolunteerRegistrationModel extends Model
{
    protected $table            = 'volunteer_registrations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nik',
        'nama',
        'provinsi',
        'tgl_lahir',
        'whatsapp',
        'posko_name',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
