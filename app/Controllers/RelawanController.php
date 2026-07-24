<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RelawanController extends Controller
{
    public function posko($poskoId = 1)
    {
        $userPoskoId = session()->get('posko_id') ?: $poskoId;
        return redirect()->to('/posko/' . $userPoskoId);
    }
}
