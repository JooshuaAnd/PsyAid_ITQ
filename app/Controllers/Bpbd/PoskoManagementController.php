<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use App\Models\PoskoModel;
use CodeIgniter\Database\RawSql;

class PoskoManagementController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $poskoModel = new PoskoModel();

        // 1. Load All Provinces
        $provinces = $db->table('provinces')->orderBy('name', 'ASC')->get()->getResultArray();

        // 2. Read GET Filters
        $provinceId   = trim($this->request->getGet('province_id') ?? '');
        $regencyId    = trim($this->request->getGet('regency_id') ?? '');
        $jenisBencana = trim($this->request->getGet('jenis_bencana') ?? '');
        $status       = trim($this->request->getGet('status') ?? '');
        $search       = trim($this->request->getGet('q') ?? '');

        // 3. Load Regencies if Province is selected
        $regencies = [];
        if (! empty($provinceId)) {
            $regencies = $db->table('regencies')
                ->where('province_id', $provinceId)
                ->orderBy('name', 'ASC')
                ->get()
                ->getResultArray();
        }

        // 4. Build Posko Query
        $builder = $db->table('posko')
            ->select('posko.*, regencies.name as regency_name, regencies.province_id, provinces.name as province_name')
            ->join('regencies', 'regencies.id = posko.regency_id', 'left')
            ->join('provinces', 'provinces.id = regencies.province_id', 'left');

        if (! empty($provinceId)) {
            $builder->where('regencies.province_id', $provinceId);
        }

        if (! empty($regencyId)) {
            $builder->where('posko.regency_id', $regencyId);
        }

        if (! empty($jenisBencana)) {
            $builder->where('posko.jenis_bencana', $jenisBencana);
        }

        if (! empty($status)) {
            $builder->where('posko.status', $status);
        }

        if (! empty($search)) {
            $builder->groupStart()
                ->like('posko.name', $search)
                ->orLike('posko.jenis_bencana', $search)
                ->orLike('regencies.name', $search)
                ->orLike('provinces.name', $search)
                ->groupEnd();
        }

        $poskoList = $builder->orderBy('posko.id', 'DESC')->get()->getResultArray();

        // Count approved volunteers per posko
        foreach ($poskoList as &$p) {
            $approvedCount = $db->table('volunteer_registrations')
                ->where('posko_name', $p['name'])
                ->where('status', 'approved')
                ->countAllResults();

            $p['approved_volunteers'] = $approvedCount;
            $p['quota'] = !empty($p['quota']) ? intval($p['quota']) : 10;
        }
        unset($p);

        $distinctJenisBencana = $poskoModel->getDistinctJenisBencana();
        if (empty($distinctJenisBencana)) {
            $distinctJenisBencana = ['Gempa Bumi', 'Banjir', 'Tanah Longsor', 'Erupsi Gunung', 'Tsunami', 'Angin Puting Beliung', 'Kebakaran Hutan'];
        }

        return view('bpbd/PoskoManagement', [
            'title'                => 'Kelola Posko Kebencanaan - BPBD',
            'provinces'            => $provinces,
            'regencies'            => $regencies,
            'poskoList'            => $poskoList,
            'distinctJenisBencana' => $distinctJenisBencana,
            'filterProvinceId'     => $provinceId,
            'filterRegencyId'      => $regencyId,
            'filterJenisBencana'   => $jenisBencana,
            'filterStatus'         => $status,
            'searchQuery'          => $search,
        ]);
    }

    /**
     * AJAX Endpoint to fetch regencies by province ID
     */
    public function getRegencies($provinceId)
    {
        $db = \Config\Database::connect();
        $regencies = $db->table('regencies')
            ->where('province_id', $provinceId)
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $regencies,
        ]);
    }

    /**
     * Create New Posko
     */
    public function store()
    {
        $rules = [
            'name'          => 'required|min_length[3]|max_length[150]',
            'regency_id'    => 'required|numeric',
            'jenis_bencana' => 'required',
            'quota'         => 'required|numeric|greater_than[0]',
            'status'        => 'required|in_list[aktif,recovery,closed]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $poskoModel = new PoskoModel();

        $data = [
            'name'           => trim($this->request->getPost('name')),
            'regency_id'     => intval($this->request->getPost('regency_id')),
            'jenis_bencana'  => trim($this->request->getPost('jenis_bencana')),
            'status'         => trim($this->request->getPost('status')),
            'quota'          => intval($this->request->getPost('quota')),
            'filled'         => 0,
            'urgency'        => trim($this->request->getPost('urgency') ?? 'Urgent'),
            'positions'      => trim($this->request->getPost('positions') ?? ''),
            'requirements'   => trim($this->request->getPost('requirements') ?? ''),
            'contact_person' => trim($this->request->getPost('contact_person') ?? ''),
        ];

        $poskoModel->insert($data);

        return redirect()->to('/bpbd/manage-posko')->with('success', 'Posko Bencana "' . esc($data['name']) . '" berhasil dibuat. Posko aktif secara otomatis akan muncul pada portal Rekrutmen Relawan!');
    }

    /**
     * Update Existing Posko
     */
    public function update($id)
    {
        $poskoModel = new PoskoModel();
        $posko = $poskoModel->find($id);

        if (! $posko) {
            return redirect()->to('/bpbd/manage-posko')->with('error', 'Posko tidak ditemukan.');
        }

        $rules = [
            'name'          => 'required|min_length[3]|max_length[150]',
            'regency_id'    => 'required|numeric',
            'jenis_bencana' => 'required',
            'quota'         => 'required|numeric|greater_than[0]',
            'status'        => 'required|in_list[aktif,recovery,closed]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'           => trim($this->request->getPost('name')),
            'regency_id'     => intval($this->request->getPost('regency_id')),
            'jenis_bencana'  => trim($this->request->getPost('jenis_bencana')),
            'status'         => trim($this->request->getPost('status')),
            'quota'          => intval($this->request->getPost('quota')),
            'urgency'        => trim($this->request->getPost('urgency') ?? 'Urgent'),
            'positions'      => trim($this->request->getPost('positions') ?? ''),
            'requirements'   => trim($this->request->getPost('requirements') ?? ''),
            'contact_person' => trim($this->request->getPost('contact_person') ?? ''),
        ];

        $poskoModel->update($id, $data);

        return redirect()->to('/bpbd/manage-posko')->with('success', 'Data Posko Bencana "' . esc($data['name']) . '" berhasil diperbarui.');
    }

    /**
     * Delete Posko
     */
    public function delete($id)
    {
        $poskoModel = new PoskoModel();
        $posko = $poskoModel->find($id);

        if (! $posko) {
            return redirect()->to('/bpbd/manage-posko')->with('error', 'Posko tidak ditemukan.');
        }

        $poskoModel->delete($id);

        return redirect()->to('/bpbd/manage-posko')->with('success', 'Posko Bencana "' . esc($posko['name']) . '" berhasil dihapus.');
    }
}
