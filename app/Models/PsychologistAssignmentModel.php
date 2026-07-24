<?php

namespace App\Models;

use CodeIgniter\Model;

class PsychologistAssignmentModel extends Model
{
    protected $table            = 'psychologist_assignment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['victim_id', 'psikolog_id', 'assigned_at', 'jumlah_kasus_saat_assign'];
}
