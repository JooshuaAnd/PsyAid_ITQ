<?php

namespace App\Controllers\Relawan;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RelawanController extends BaseController
{
    public function posko($poskoId = 1)
    {
        $userPoskoId = (int) (session()->get('posko_id') ?? 0);
        if ($userPoskoId <= 0) {
            return redirect()->to('/relawan/posko-tidak-tersedia');
        }

        // Never let a stale bookmark or a cached URL move a volunteer into a
        // different post. The assignment stored in the current session is the
        // only valid workspace for this role.
        if ((int) $poskoId !== $userPoskoId) {
            return redirect()->to('/relawan/posko/' . $userPoskoId);
        }

        return redirect()->to('/posko/' . $userPoskoId);
    }

    public function poskoTidakTersedia()
    {
        // Refresh the assignment from the database so a BPBD correction takes
        // effect without forcing the volunteer to clear app data or reinstall.
        $user = (new UserModel())->find((int) session()->get('user_id'));
        $freshPoskoId = (int) ($user['posko_id'] ?? 0);
        if ($freshPoskoId > 0) {
            $poskoExists = \Config\Database::connect()
                ->table('posko')
                ->select('id')
                ->where('id', $freshPoskoId)
                ->countAllResults() > 0;

            if ($poskoExists) {
                session()->set('posko_id', $freshPoskoId);
                return redirect()->to('/relawan/posko/' . $freshPoskoId);
            }
        }

        return view('relawan/PoskoUnavailable', [
            'title' => 'Posko Relawan Belum Tersedia - PsyAid',
        ]);
    }
}
