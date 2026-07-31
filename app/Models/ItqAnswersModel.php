<?php

namespace App\Models;

use CodeIgniter\Model;

class ItqAnswersModel extends Model
{
    protected $table            = 'itq_answers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'victim_id', 'psikolog_id',
        'item_1', 'item_2', 'item_3', 'item_4', 'item_5', 'item_6',
        'item_7', 'item_8', 'item_9', 'item_10', 'item_11', 'item_12',
        'item_13', 'item_14', 'item_15', 'item_16', 'item_17', 'item_18',
        'created_at', 'fase_ke'
    ];

    public function getByVictimId(int $victimId, int $faseKe = 0): ?array
    {
        return $this->where('victim_id', $victimId)->where('fase_ke', $faseKe)->first();
    }
}
