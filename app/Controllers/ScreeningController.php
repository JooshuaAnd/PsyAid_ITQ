<?php

namespace App\Controllers;

use App\Models\VolunteerScreeningModel;
use CodeIgniter\Controller;

class ScreeningController extends Controller
{
    /**
     * Process Volunteer Screening Form Submission (SEGMEN 7 & 8)
     */
    public function store($victimId)
    {
        $userRole = session()->get('role');
        if (! in_array($userRole, ['relawan', 'psikolog'], true)) {
            return redirect()->to('/victim/detail/' . $victimId)->with('error', 'Akses ditolak: BPBD Admin dilarang melakukan skrining relawan.');
        }

        // Validate attached files only if file inputs are present and not empty
        $rules = [];
        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->isValid()) {
            $rules['foto'] = 'max_size[foto,10240]|is_image[foto]';
        }
        $voiceFile = $this->request->getFile('voice_note');
        if ($voiceFile && $voiceFile->isValid()) {
            $rules['voice_note'] = 'max_size[voice_note,20480]|ext_in[voice_note,mp3,wav,m4a,ogg]';
        }
        $videoFile = $this->request->getFile('video');
        if ($videoFile && $videoFile->isValid()) {
            $rules['video'] = 'max_size[video,51200]|ext_in[video,mp4,mkv,avi,webm]';
        }
        $docFile = $this->request->getFile('dokumen');
        if ($docFile && $docFile->isValid()) {
            $rules['dokumen'] = 'max_size[dokumen,15360]|ext_in[dokumen,pdf,doc,docx]';
        }

        if (! empty($rules) && ! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload Directory Path: writable/uploads/victim_{id}/
        $uploadDir = WRITEPATH . 'uploads/victim_' . $victimId;
        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Handle File Uploads
        $fotoPath      = $this->handleUpload('foto', $uploadDir, 'image');
        $voiceNotePath = $this->handleUpload('voice_note', $uploadDir, 'audio');
        $videoPath     = $this->handleUpload('video', $uploadDir, 'video');
        $dokumenPath   = $this->handleUpload('dokumen', $uploadDir, 'document');

        $menyebutInginMati  = $this->request->getPost('menyebut_ingin_mati') ? 1 : 0;
        $mengancamBunuhDiri = $this->request->getPost('mengancam_bunuh_diri') ? 1 : 0;
        $melukaiDiri        = $this->request->getPost('melukai_diri') ? 1 : 0;

        $screeningModel = new VolunteerScreeningModel();
        $existing       = $screeningModel->getByVictimId((int) $victimId);

        $data = [
            'victim_id'            => (int) $victimId,
            'mampu_sebut_nama'     => $this->request->getPost('mampu_sebut_nama') ? 1 : 0,
            'mampu_sebut_lokasi'   => $this->request->getPost('mampu_sebut_lokasi') ? 1 : 0,
            'mampu_sebut_tanggal'  => $this->request->getPost('mampu_sebut_tanggal') ? 1 : 0,
            'kontak_mata'          => $this->request->getPost('kontak_mata') ?: 'baik',
            'bicara'               => $this->request->getPost('bicara') ?: 'normal',
            'menangis_terus'       => $this->request->getPost('menangis_terus') ? 1 : 0,
            'tampak_panik'         => $this->request->getPost('tampak_panik') ? 1 : 0,
            'sulit_ditenangkan'    => $this->request->getPost('sulit_ditenangkan') ? 1 : 0,
            'gemetar'              => $this->request->getPost('gemetar') ? 1 : 0,
            'berteriak_histeris'   => $this->request->getPost('berteriak_histeris') ? 1 : 0,
            'diam_total'           => $this->request->getPost('diam_total') ? 1 : 0,
            'menghindari_orang'    => $this->request->getPost('menghindari_orang') ? 1 : 0,
            'menyebut_ingin_mati'  => $menyebutInginMati,
            'mengancam_bunuh_diri' => $mengancamBunuhDiri,
            'melukai_diri'         => $melukaiDiri,
            'agresif'              => $this->request->getPost('agresif') ? 1 : 0,
            'mencari_keluarga'     => $this->request->getPost('mencari_keluarga') ? 1 : 0,
            'sulit_tidur'          => $this->request->getPost('sulit_tidur') ? 1 : 0,
            'mimpi_buruk'          => $this->request->getPost('mimpi_buruk') ? 1 : 0,
            'tidak_mau_makan'      => $this->request->getPost('tidak_mau_makan') ? 1 : 0,
            'skala_distress'       => 0,
            'catatan_relawan'      => null,
            'foto_path'            => $fotoPath ?: ($existing['foto_path'] ?? null),
            'voice_note_path'      => $voiceNotePath ?: ($existing['voice_note_path'] ?? null),
            'video_path'           => $videoPath ?: ($existing['video_path'] ?? null),
            'dokumen_path'         => $dokumenPath ?: ($existing['dokumen_path'] ?? null),
            'relawan_id'           => session()->get('user_id') ?? 2,
            'created_at'           => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $screeningModel->update($existing['id'], $data);
        } else {
            $screeningModel->insert($data);
        }

        // Trigger AI Assessment Service (SEGMEN 8)
        $this->generateAiAssessment((int) $victimId, $data);

        // Emergency Suicide Alert Check
        if ($menyebutInginMati || $mengancamBunuhDiri || $melukaiDiri) {
            return redirect()->to('/victim/detail/' . $victimId . '?tab=ai')
                ->with('activeTab', 'ai')
                ->with('error', '⚠️ PERINGATAN KRISIS DARURAT: Data skrining berhasil disimpan & AI Clinical Decision Support aktif. TERDETEKSI INDIKASI RISIKO BUNUH DIRI / MELUKAI DIRI! Harap SEGERA hubungi Psikolog Jaga Posko / Hotline 0800-1-PSY-AID!');
        }

        return redirect()->to('/victim/detail/' . $victimId . '?tab=ai')
            ->with('activeTab', 'ai')
            ->with('success', 'Skrining awal relawan berhasil disimpan dan AI Clinical Decision Support telah aktif secara otomatis!');
    }

    /**
     * File Upload Helper
     */
    private function handleUpload(string $inputName, string $uploadDir, string $type): ?string
    {
        $file = $this->request->getFile($inputName);
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadDir, $newName);
            return 'uploads/victim_' . basename($uploadDir) . '/' . $newName;
        }
        return null;
    }

    /**
     * Trigger AI Decision Support Service (SEGMEN 8)
     */
    private function generateAiAssessment(int $victimId, array $screening)
    {
        $service = new \App\Services\AiAssessmentService();
        $service->calculateRisk($victimId);
    }

    /**
     * Re-trigger AI Decision Support Analysis (Gemini / Rule Engine)
     */
    public function reassess($victimId)
    {
        $service = new \App\Services\AiAssessmentService();
        $result  = $service->calculateRisk((int) $victimId);

        $isGemini = strpos($result['ai_summary'] ?? '', '[Gemini AI]') !== false;
        $engine   = $isGemini ? 'Google Gemini API' : 'Rule-Based Engine (Fallback)';

        return redirect()->to('/victim/detail/' . $victimId . '?tab=ai')
            ->with('activeTab', 'ai')
            ->with('success', 'AI Clinical Decision Support berhasil di-analisis ulang menggunakan ' . $engine . '!');
    }
}

