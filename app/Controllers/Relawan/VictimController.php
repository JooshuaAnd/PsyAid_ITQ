<?php

namespace App\Controllers\Relawan;

use App\Controllers\BaseController;
use App\Models\DisasterInfoModel;
use App\Models\PsychologicalHistoryModel;
use App\Models\UserModel;
use App\Models\VictimModel;
use App\Models\VolunteerScreeningModel;
use CodeIgniter\Controller;

class VictimController extends Controller
{
    /**
     * Display Form to Create New Victim Entry (No DB Insertion Yet)
     */
    public function create($poskoId = 1)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('posko');
        $builder->select('
            posko.*,
            regencies.name as regency_name, provinces.name as province_name
        ');
        $builder->join('regencies', 'regencies.id = posko.regency_id', 'left');
        $builder->join('provinces', 'provinces.id = regencies.province_id', 'left');
        $builder->where('posko.id', $poskoId);
        $posko = $builder->get()->getRowArray();

        if (!$posko) {
            return redirect()->to('/command-center')->with('error', 'Posko tidak ditemukan.');
        }

        $victim = [
            'id' => null,
            'posko_id' => (int) $poskoId,
            'posko_name' => $posko['name'] ?? '',
            'posko_bencana' => $posko['jenis_bencana'] ?? 'Gempa Bumi',
            'regency_name' => $posko['regency_name'] ?? '',
            'province_name' => $posko['province_name'] ?? '',
            'nama' => '',
            'jenis_kelamin' => 'L',
            'umur' => '',
            'nik' => '',
            'no_hp_keluarga' => '',
            'alamat' => '',
            'tanggal_datang' => '',
            'jam_datang' => '',
            'ditemukan_oleh_relawan_id' => session()->get('user_id'),
            'relawan_nama' => session()->get('name'),
        ];

        // Fetch list of Relawan Users for selection
        $userModel = new UserModel();
        $relawanList = $userModel->where('role', 'relawan')->findAll();

        $data = [
            'title' => 'Tambah Penyintas Baru - ' . $posko['name'],
            'victim' => $victim,
            'disasterInfo' => [],
            'psychHist' => [],
            'savedDiagnoses' => [],
            'screening' => null,
            'aiAssessment' => null,
            'itqResult' => null,
            'relawanList' => $relawanList,
            'userRole' => session()->get('role'),
            'activeTab' => 'identitas',
            'isCreate' => true,
        ];

        return view('relawan/VictimDetail', $data);
    }

    /**
     * Process Store New Victim Entry
     */
    public function store($poskoId = 1)
    {
        // CI4 Form Validation
        $rules = [
            'nama' => 'required|min_length[2]|max_length[150]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'umur' => 'required|numeric|greater_than[0]|max_length[2]',
            'nik' => 'permit_empty|exact_length[16]|numeric',
            'no_hp_keluarga' => 'required',
            'tanggal_datang' => 'required|valid_date',
            'jam_datang' => 'required',
        ];

        $messages = [
            'nama' => [
                'required' => 'Nama penyintas wajib diisi.',
            ],
            'umur' => [
                'required' => 'Umur wajib diisi dengan angka.',
                'numeric' => 'Umur harus berupa angka.',
                'max_length' => 'Umur maksimal 2 digit angka.',
            ],
            'nik' => [
                'exact_length' => 'NIK harus persis 16 digit angka.',
                'numeric' => 'NIK harus berupa digit angka.',
            ],
            'no_hp_keluarga' => [
                'required' => 'No HP / Kontak Keluarga wajib diisi.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $victimModel = new VictimModel();
        $victimData = [
            'posko_id' => (int) $poskoId,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => (int) $this->request->getPost('umur'),
            'nik' => $this->request->getPost('nik') ?: null,
            'no_hp_keluarga' => $this->request->getPost('no_hp_keluarga') ?: null,
            'alamat' => $this->request->getPost('alamat') ?: null,
            'tanggal_datang' => $this->request->getPost('tanggal_datang'),
            'jam_datang' => $this->request->getPost('jam_datang'),
            'ditemukan_oleh_relawan_id' => $this->request->getPost('ditemukan_oleh_relawan_id') ?: session()->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $newId = $victimModel->insert($victimData);

        // Store Disaster Info if provided
        $disasterInfoModel = new DisasterInfoModel();
        $disasterData = [
            'victim_id' => (int) $newId,
            'jenis_bencana' => $this->request->getPost('jenis_bencana') ?: 'Gempa Bumi',
            'tanggal' => $this->request->getPost('tanggal_bencana') ?: date('Y-m-d'),
            'durasi_terjebak' => $this->request->getPost('durasi_terjebak') ?: '<1 jam',
            'mengungsi' => $this->request->getPost('mengungsi') ? true : false,
            'kehilangan_rumah' => $this->request->getPost('kehilangan_rumah') ? true : false,
            'kehilangan_keluarga' => $this->request->getPost('kehilangan_keluarga') ? true : false,
            'cedera' => $this->request->getPost('cedera') ? true : false,
            'rawat_inap' => $this->request->getPost('rawat_inap') ? true : false,
            'saksi_kematian' => $this->request->getPost('saksi_kematian') ? true : false,
        ];
        $disasterInfoModel->insert($disasterData);

        $nextTab = $this->request->getPost('next_tab') ?: 'bencana';
        return redirect()->to('/victim/detail/' . $newId . '?tab=' . $nextTab)
            ->with('activeTab', $nextTab)
            ->with('success', 'Data Penyintas Baru berhasil disimpan! Silakan lanjutkan pengisian.');
    }

    /**
     * Display Victim Details (Single Page Tabs)
     */
    public function detail($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('victims');
        $builder->select('
            victims.*,
            posko.name as posko_name, posko.jenis_bencana as posko_bencana,
            regencies.name as regency_name, provinces.name as province_name,
            relawan_user.name as relawan_nama
        ');
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('regencies', 'regencies.id = posko.regency_id');
        $builder->join('provinces', 'provinces.id = regencies.province_id');
        $builder->join('users as relawan_user', 'relawan_user.id = victims.ditemukan_oleh_relawan_id', 'left');
        $builder->where('victims.id', $id);
        $victim = $builder->get()->getRowArray();

        if (!$victim) {
            return redirect()->to('/command-center')->with('error', 'Data penyintas tidak ditemukan.');
        }

        // Fetch Disaster Info
        $disasterInfoModel = new DisasterInfoModel();
        $disasterInfo = $disasterInfoModel->getByVictimId((int) $id);

        // Fetch Psychological History (SEGMEN 6)
        $psychModel = new PsychologicalHistoryModel();
        $psychHist = $psychModel->getByVictimId((int) $id);

        // Decode JSON diagnosis if exists
        $savedDiagnoses = [];
        if (!empty($psychHist['diagnosis_sebelumnya'])) {
            $decoded = json_decode($psychHist['diagnosis_sebelumnya'], true);
            if (is_array($decoded)) {
                $savedDiagnoses = $decoded;
            }
        }

        // Fetch Volunteer Screening (SEGMEN 7)
        $screeningModel = new VolunteerScreeningModel();
        $screening = $screeningModel->getByVictimId((int) $id);

        // Fetch AI Assessment (SEGMEN 8)
        $aiModel = new \App\Models\AiAssessmentModel();
        $aiAssessment = $aiModel->where('victim_id', $id)->first();

        // Fetch ITQ Result (SEGMEN 13)
        $itqResultModel = new \App\Models\ItqResultModel();
        $itqResult = $itqResultModel->getByVictimId((int) $id);

        // Fetch list of Relawan Users for selection
        $userModel = new UserModel();
        $relawanList = $userModel->where('role', 'relawan')->findAll();

        $data = [
            'title' => 'Detail Penyintas - ' . $victim['nama'],
            'victim' => $victim,
            'disasterInfo' => $disasterInfo,
            'psychHist' => $psychHist,
            'savedDiagnoses' => $savedDiagnoses,
            'screening' => $screening,
            'aiAssessment' => $aiAssessment,
            'itqResult' => $itqResult,
            'relawanList' => $relawanList,
            'userRole' => session()->get('role'),
            'activeTab' => session()->getFlashdata('activeTab') ?? $this->request->getGet('tab') ?? 'identitas',
        ];


        return view('relawan/VictimDetail', $data);
    }

    /**
     * Process Update Identitas & Informasi Bencana
     */
    public function update($id)
    {
        $victimModel = new VictimModel();
        $victim = $victimModel->find($id);

        if (!$victim) {
            return redirect()->to('/command-center')->with('error', 'Penyintas tidak ditemukan.');
        }

        // CI4 Form Validation
        $rules = [
            'nama' => 'required|min_length[2]|max_length[150]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'umur' => 'required|numeric|greater_than[0]|max_length[2]',
            'nik' => 'permit_empty|exact_length[16]|numeric',
            'no_hp_keluarga' => 'required',
            'tanggal_datang' => 'required|valid_date',
            'jam_datang' => 'required',
        ];

        $messages = [
            'nama' => [
                'required' => 'Nama penyintas wajib diisi.',
            ],
            'umur' => [
                'required' => 'Umur wajib diisi dengan angka.',
                'numeric' => 'Umur harus berupa angka.',
                'max_length' => 'Umur maksimal 2 digit angka.',
            ],
            'nik' => [
                'exact_length' => 'NIK harus persis 16 digit angka.',
                'numeric' => 'NIK harus berupa digit angka.',
            ],
            'no_hp_keluarga' => [
                'required' => 'No HP / Kontak Keluarga wajib diisi.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 1. Update Victims table
        $victimData = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => (int) $this->request->getPost('umur'),
            'nik' => $this->request->getPost('nik') ?: null,
            'no_hp_keluarga' => $this->request->getPost('no_hp_keluarga') ?: null,
            'alamat' => $this->request->getPost('alamat') ?: null,
            'tanggal_datang' => $this->request->getPost('tanggal_datang'),
            'jam_datang' => $this->request->getPost('jam_datang'),
            'ditemukan_oleh_relawan_id' => $this->request->getPost('ditemukan_oleh_relawan_id') ?: null,
        ];
        $victimModel->update($id, $victimData);

        // 2. Update/Upsert Disaster Info table
        $disasterInfoModel = new DisasterInfoModel();
        $existingDisaster = $disasterInfoModel->getByVictimId((int) $id);

        $disasterData = [
            'victim_id' => (int) $id,
            'jenis_bencana' => $this->request->getPost('jenis_bencana') ?: $victim['posko_bencana'] ?? 'Gempa Bumi',
            'tanggal' => $this->request->getPost('tanggal_bencana') ?: date('Y-m-d'),
            'durasi_terjebak' => $this->request->getPost('durasi_terjebak') ?: '<1 jam',
            'mengungsi' => $this->request->getPost('mengungsi') ? true : false,
            'kehilangan_rumah' => $this->request->getPost('kehilangan_rumah') ? true : false,
            'kehilangan_keluarga' => $this->request->getPost('kehilangan_keluarga') ? true : false,
            'cedera' => $this->request->getPost('cedera') ? true : false,
            'rawat_inap' => $this->request->getPost('rawat_inap') ? true : false,
            'saksi_kematian' => $this->request->getPost('saksi_kematian') ? true : false,
        ];

        if ($existingDisaster) {
            $disasterInfoModel->update($existingDisaster['id'], $disasterData);
        } else {
            $disasterInfoModel->insert($disasterData);
        }

        $nextTab = $this->request->getPost('next_tab') ?: 'bencana';
        return redirect()->to('/victim/detail/' . $id . '?tab=' . $nextTab)
            ->with('activeTab', $nextTab)
            ->with('success', 'Data berhasil disimpan! Melanjutkan ke tahap selanjutnya.');
    }

    /**
     * Process Update Riwayat Psikologis (SEGMEN 6)
     */
    public function updatePsychologicalHistory($id)
    {
        // Role Check: ONLY relawan & psikolog allowed to edit sensitive psychological history
        $userRole = session()->get('role');
        if (!in_array($userRole, ['relawan', 'psikolog'], true)) {
            return redirect()->to('/victim/detail/' . $id)->with('error', 'Akses ditolak: BPBD Admin dilarang menyunting data psikologis sensitif individual.');
        }

        $diagnosesInput = $this->request->getPost('diagnosis') ?: [];
        $diagnosisLain = trim($this->request->getPost('diagnosis_lainnya') ?? '');
        if ($diagnosisLain !== '') {
            $diagnosesInput[] = 'Lainnya: ' . $diagnosisLain;
        }

        $jsonDiagnosis = json_encode(array_values($diagnosesInput));

        $psychModel = new PsychologicalHistoryModel();
        $existing = $psychModel->getByVictimId((int) $id);

        $data = [
            'victim_id' => (int) $id,
            'pernah_konsultasi' => $this->request->getPost('pernah_konsultasi') ? true : false,
            'pernah_dirawat_psikiater' => $this->request->getPost('pernah_dirawat_psikiater') ? true : false,
            'diagnosis_sebelumnya' => $jsonDiagnosis,
            'sedang_konsumsi_obat' => $this->request->getPost('sedang_konsumsi_obat') ? true : false,
            'nama_obat' => $this->request->getPost('nama_obat') ?: null,
            'dosis' => $this->request->getPost('dosis') ?: null,
            'dokter' => $this->request->getPost('dokter') ?: null,
            'riwayat_percobaan_bunuh_diri' => $this->request->getPost('riwayat_percobaan_bunuh_diri') ? true : false,
            'riwayat_melukai_diri' => $this->request->getPost('riwayat_melukai_diri') ? true : false,
            'riwayat_napza' => $this->request->getPost('riwayat_napza') ? true : false,
            'riwayat_penyakit_kronis' => $this->request->getPost('riwayat_penyakit_kronis') ? true : false,
            'keterangan_penyakit_kronis' => $this->request->getPost('keterangan_penyakit_kronis') ?: null,
        ];

        if ($existing) {
            $psychModel->update($existing['id'], $data);
        } else {
            $psychModel->insert($data);
        }

        $nextTab = $this->request->getPost('next_tab') ?: 'screening';
        return redirect()->to('/victim/detail/' . $id . '?tab=' . $nextTab)
            ->with('activeTab', $nextTab)
            ->with('success', 'Data Riwayat Psikologis berhasil disimpan! Melanjutkan ke Skrining Relawan.');
    }

    /**
     * Return JSON endpoint for Victim Summary & AI Assessment
     */
    public function detailJson($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('victims');
        $builder->select('
            victims.*,
            posko.name as posko_name, posko.jenis_bencana as posko_bencana,
            regencies.name as regency_name, provinces.name as province_name,
            relawan_user.name as relawan_nama
        ');
        $builder->join('posko', 'posko.id = victims.posko_id');
        $builder->join('regencies', 'regencies.id = posko.regency_id');
        $builder->join('provinces', 'provinces.id = regencies.province_id');
        $builder->join('users as relawan_user', 'relawan_user.id = victims.ditemukan_oleh_relawan_id', 'left');
        $builder->where('victims.id', $id);
        $victim = $builder->get()->getRowArray();

        if (!$victim) {
            return $this->response->setJSON(['success' => false, 'message' => 'Penyintas tidak ditemukan']);
        }

        $disasterInfoModel = new DisasterInfoModel();
        $disasterInfo = $disasterInfoModel->getByVictimId((int) $id);

        $psychModel = new PsychologicalHistoryModel();
        $psychHist = $psychModel->getByVictimId((int) $id);

        $savedDiagnoses = [];
        if (!empty($psychHist['diagnosis_sebelumnya'])) {
            $decoded = json_decode($psychHist['diagnosis_sebelumnya'], true);
            if (is_array($decoded)) {
                $savedDiagnoses = $decoded;
            }
        }

        $screeningModel = new VolunteerScreeningModel();
        $screening = $screeningModel->getByVictimId((int) $id);

        $aiModel = new \App\Models\AiAssessmentModel();
        $aiAssessment = $aiModel->where('victim_id', $id)->first();

        $itqResultModel = new \App\Models\ItqResultModel();
        $itqResult = $itqResultModel->getByVictimId((int) $id);

        return $this->response->setJSON([
            'success' => true,
            'victim' => $victim,
            'disasterInfo' => $disasterInfo,
            'psychHist' => $psychHist,
            'savedDiagnoses' => $savedDiagnoses,
            'screening' => $screening,
            'aiAssessment' => $aiAssessment,
            'itqResult' => $itqResult
        ]);
    }

}
