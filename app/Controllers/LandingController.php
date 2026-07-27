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
            ->join('provinces', 'provinces.id = regencies.province_id', 'left');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('posko.name', $search)
                ->orLike('posko.jenis_bencana', $search)
                ->orLike('regencies.name', $search)
                ->groupEnd();
        }

        if (! empty($bencana)) {
            $builder->where('posko.jenis_bencana', $bencana);
        }

        $poskoList = $builder->orderBy('posko.id', 'ASC')->findAll();

        // Enhance each posko with recruitment metadata posted by BPBD
        $recruitmentListings = array_map(function ($posko) {
            $id = $posko['id'];

            $recruitmentSpecs = [
                1 => [
                    'quota'          => 15,
                    'filled'         => 8,
                    'urgency'        => 'Urgent',
                    'positions'      => ['Relawan Pendampingan Psikososial', 'Relawan Asesmen ITQ', 'Relawan Logistik Posko'],
                    'requirements'   => ['Pria/Wanita min. 18 tahun', 'Komunikatif & memiliki kepedulian sosial tinggi', 'Bersedia bertugas di area Cianjur'],
                    'contact_person' => 'BPBD Command Center Cianjur (0812-3456-7890)',
                ],
                2 => [
                    'quota'          => 20,
                    'filled'         => 12,
                    'urgency'        => 'Urgent',
                    'positions'      => ['Relawan Dapur Umum & Logistik', 'Relawan Medis / P3K', 'Relawan Pendamping Anak'],
                    'requirements'   => ['Sehat jasmani & rohani', 'Siap ditempatkan di Posko Magelang', 'Mengikuti pengarahan keselamatan BPBD'],
                    'contact_person' => 'BPBD Command Center Magelang (0813-9876-5432)',
                ],
                3 => [
                    'quota'          => 10,
                    'filled'         => 6,
                    'urgency'        => 'Terbuka',
                    'positions'      => ['Relawan Pemulihan Mental', 'Relawan Distribusi Bantuan'],
                    'requirements'   => ['Dapat bekerja dalam tim', 'Penempatan Karanganyar'],
                    'contact_person' => 'BPBD Command Center Karanganyar (0815-1122-3344)',
                ],
            ];

            $spec = $recruitmentSpecs[$id] ?? [
                'quota'          => 10,
                'filled'         => 4,
                'urgency'        => 'Terbuka',
                'positions'      => ['Relawan Posko Bencana', 'Relawan Pendampingan ITQ'],
                'requirements'   => ['Sehat jasmani & rohani', 'Bersedia ditugaskan di lokasi posko'],
                'contact_person' => 'BPBD Command Center (0812-0000-1111)',
            ];

            return array_merge($posko, $spec);
        }, $poskoList);

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
        $regModel = new VolunteerRegistrationModel();

        $nik       = trim($this->request->getPost('nik') ?? '');
        $nama      = trim($this->request->getPost('nama') ?? '');
        $provinsi  = trim($this->request->getPost('provinsi') ?? '');
        $tglLahir  = trim($this->request->getPost('tgl_lahir') ?? '');
        $whatsapp  = trim($this->request->getPost('whatsapp') ?? '');
        $poskoName = trim($this->request->getPost('posko_name') ?? '');

        if (empty($nik) || empty($nama) || empty($whatsapp)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Data pendaftaran tidak lengkap.',
            ])->setStatusCode(400);
        }

        $regModel->insert([
            'nik'        => $nik,
            'nama'       => $nama,
            'provinsi'   => $provinsi,
            'tgl_lahir'  => ! empty($tglLahir) ? $tglLahir : null,
            'whatsapp'   => $whatsapp,
            'posko_name' => $poskoName,
            'status'     => 'pending',
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Permohonan akun relawan berhasil terkirim ke BPBD Command Center.',
        ]);
    }
}
