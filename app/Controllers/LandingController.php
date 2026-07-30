<?php

namespace App\Controllers;

use App\Models\PoskoModel;
use App\Models\VolunteerRegistrationModel;

class LandingController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'      => 'PsyAid - Disaster Mental Health Command Center',
            'isLoggedIn' => session()->get('logged_in') ?? false,
            'role'       => session()->get('role') ?? null,
            'poskoId'    => session()->get('posko_id') ?? null,
        ];

        return view('landing/index', $data);
    }

    /**
     * Public Volunteer Recruitment Page
     */
    public function rekrutmen()
    {
        $poskoModel = new PoskoModel();
        $search     = trim($this->request->getGet('q') ?? '');
        $bencana    = trim($this->request->getGet('bencana') ?? '');

        $builder = $poskoModel->select('posko.*, regencies.name as regency_name, provinces.name as province_name')
            ->join('regencies', 'regencies.id = posko.regency_id', 'left')
            ->join('provinces', 'provinces.id = regencies.province_id', 'left')
            ->where('posko.status', 'aktif');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('posko.name', $search)
                ->orLike('posko.jenis_bencana', $search)
                ->orLike('regencies.name', $search)
                ->orLike('provinces.name', $search)
                ->groupEnd();
        }

        if (! empty($bencana)) {
            $builder->where('posko.jenis_bencana', $bencana);
        }

        $allPosko = $builder->orderBy('posko.id', 'ASC')->findAll();

        $volModel = new VolunteerRegistrationModel();

        $recruitmentListings = [];

        foreach ($allPosko as $posko) {
            $poskoName = $posko['name'];

            // Count approved volunteers for this posko
            $approvedCount = $volModel->where('posko_name', $poskoName)->where('status', 'approved')->countAllResults();

            $quota  = ! empty($posko['quota']) && intval($posko['quota']) > 0 ? intval($posko['quota']) : 10;
            $filled = $approvedCount > 0 ? $approvedCount : (isset($posko['filled']) ? intval($posko['filled']) : 0);

            // Filter out posko if volunteer slots are full (filled >= quota)
            if ($filled >= $quota) {
                continue;
            }

            // Parse requirements options (support array, JSON, newline-delimited, or comma-delimited)
            if (! empty($posko['requirements'])) {
                if (is_array($posko['requirements'])) {
                    $requirements = array_values(array_filter(array_map('trim', $posko['requirements'])));
                } else {
                    $jsonDecoded = json_decode($posko['requirements'], true);
                    if (is_array($jsonDecoded)) {
                        $requirements = array_values(array_filter(array_map('trim', $jsonDecoded)));
                    } else if (strpos($posko['requirements'], "\n") !== false) {
                        $requirements = array_values(array_filter(array_map('trim', explode("\n", $posko['requirements']))));
                    } else {
                        $requirements = array_values(array_filter(array_map('trim', explode(',', $posko['requirements']))));
                    }
                }
            } else {
                $requirements = ['Pria/Wanita min. 18 tahun', 'Komunikatif & memiliki kepedulian sosial tinggi', 'Bersedia bertugas di lokasi posko'];
            }

            $urgency = ! empty($posko['urgency']) ? $posko['urgency'] : 'Urgent';
            $contact = ! empty($posko['contact_person']) ? $posko['contact_person'] : 'BPBD Command Center (0812-3456-7890)';

            $posko['quota']          = $quota;
            $posko['filled']         = $filled;
            $posko['urgency']        = $urgency;
            $posko['requirements']   = $requirements;
            $posko['contact_person'] = $contact;

            $recruitmentListings[] = $posko;
        }

        $distinctBencana = $poskoModel->getDistinctJenisBencana();

        return view('landing/rekrutmen', [
            'title'               => 'Rekrutmen Relawan Posko Bencana - PsyAid',
            'recruitmentListings' => $recruitmentListings,
            'distinctBencana'     => $distinctBencana,
            'searchQuery'         => $search,
            'selectedBencana'     => $bencana,
            'isLoggedIn'          => session()->get('logged_in') ?? false,
            'role'                => session()->get('role') ?? null,
            'poskoId'             => session()->get('posko_id') ?? null,
        ]);
    }

    /**
     * Handle AJAX/Fetch submission of volunteer request from chatbot
     */
    public function storeVolunteerRequest()
    {
        $input = $this->request->getJSON(true);
        if (empty($input) || !is_array($input)) {
            $input = $this->request->getPost();
        }

        $nik        = trim($input['nik'] ?? $this->request->getVar('nik') ?? '');
        $nama       = trim($input['nama'] ?? $this->request->getVar('nama') ?? '');
        $provinsi   = trim($input['provinsi'] ?? $this->request->getVar('provinsi') ?? '');
        $tglLahir   = trim($input['tgl_lahir'] ?? $this->request->getVar('tgl_lahir') ?? '');
        $whatsapp   = trim($input['whatsapp'] ?? $this->request->getVar('whatsapp') ?? '');
        $poskoName  = trim($input['posko_name'] ?? $this->request->getVar('posko_name') ?? '');

        if (empty($nik) || empty($nama) || empty($whatsapp)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'NIK, Nama Lengkap, dan Nomor WhatsApp wajib diisi.',
            ]);
        }

        $model = new VolunteerRegistrationModel();

        $data = [
            'nik'        => $nik,
            'nama'       => $nama,
            'provinsi'   => $provinsi,
            'tgl_lahir'  => ! empty($tglLahir) ? $tglLahir : null,
            'whatsapp'   => $whatsapp,
            'posko_name' => ! empty($poskoName) ? $poskoName : null,
            'status'     => 'pending',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $existing = $model->where('nik', $nik)->first();
        if ($existing) {
            $model->update($existing['id'], $data);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Permohonan pendaftaran relawan Anda berhasil diperbarui & terkirim ke BPBD.',
            ]);
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $model->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Pendaftaran relawan Anda berhasil dikirim ke BPBD. Tim kami akan menghubungi via WhatsApp.',
        ]);
    }

    /**
     * Public Disaster Report & Assistant Page (Laporan Masyarakat)
     */
    public function laporanMasyarakat()
    {
        $poskoModel = new PoskoModel();
        $provinces  = (new \App\Models\ProvinceModel())->orderBy('name', 'ASC')->findAll();

        return view('landing/LaporanMasyarakat', [
            'title'      => 'PsyAid Disaster Assistant — Laporan Bencana Masyarakat',
            'provinces'  => $provinces,
            'isLoggedIn' => session()->get('logged_in') ?? false,
            'role'       => session()->get('role') ?? null,
            'poskoId'    => session()->get('posko_id') ?? null,
        ]);
    }

    /**
     * Handle AJAX/Fetch submission of public disaster report from PsyAid Assistant
     */
    public function storeDisasterReport()
    {
        $input = $this->request->getJSON(true);
        if (empty($input) || !is_array($input)) {
            $input = $this->request->getPost();
        }
        if (empty($input) || !is_array($input)) {
            $input = $this->request->getRawInput();
        }

        $nama              = trim($input['nama'] ?? '');
        $whatsapp          = trim($input['whatsapp'] ?? '');
        $jenisBencana      = trim($input['jenis_bencana'] ?? '');
        $lokasiBencana     = trim($input['lokasi_bencana'] ?? $input['lokasi_detail'] ?? '');
        $tanggalBencana    = trim($input['tanggal_bencana'] ?? '');
        $statusBerlangsung = trim($input['status_berlangsung'] ?? 'Ya');
        $skalaKeparahan    = trim($input['skala_keparahan'] ?? '');
        $catatanTambahan   = trim($input['catatan_tambahan'] ?? '');

        if (empty($nama) || empty($whatsapp) || empty($lokasiBencana)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Nama, WhatsApp, dan Lokasi Bencana wajib diisi.',
            ]);
        }

        // Generate report ticket reference number
        $ticketCode = 'REP-' . date('Ymd') . '-' . rand(1000, 9999);

        $reportModel = new \App\Models\DisasterReportModel();
        $reportModel->insert([
            'ticket_code'        => $ticketCode,
            'nama'               => $nama,
            'whatsapp'           => $whatsapp,
            'jenis_bencana'      => $jenisBencana,
            'lokasi_bencana'     => $lokasiBencana,
            'tanggal_bencana'    => $tanggalBencana,
            'status_berlangsung' => $statusBerlangsung,
            'skala_keparahan'    => $skalaKeparahan,
            'catatan_tambahan'   => $catatanTambahan,
            'status'             => 'pending',
        ]);

        return $this->response->setJSON([
            'status'      => 'success',
            'ticket_code' => $ticketCode,
            'message'     => 'Laporan bencana berhasil dikirimkan ke BPBD Command Center.',
        ]);
    }
}
