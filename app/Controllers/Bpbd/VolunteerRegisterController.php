<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\VolunteerRegistrationModel;

class VolunteerRegisterController extends BaseController
{
    /**
     * Render Approval Akun Relawan page for BPBD Admin
     */
    public function index()
    {
        $regModel = new VolunteerRegistrationModel();
        $requests = $regModel->orderBy('id', 'DESC')->findAll();

        return view('bpbd/RegisterRelawan', [
            'title' => 'Approval Akun Relawan - BPBD Command Center',
            'requests' => $requests,
        ]);
    }

    /**
     * Approve Volunteer Registration Request & Create User Account with Random Temporary Password
     */
    public function approve($id)
    {
        $regModel = new VolunteerRegistrationModel();
        $userModel = new UserModel();

        $registration = $regModel->find($id);

        if (!$registration) {
            return redirect()->to('/bpbd/register-relawan')->with('error', 'Data permohonan relawan tidak ditemukan.');
        }

        if ($registration['status'] === 'approved') {
            return redirect()->to('/bpbd/register-relawan')->with('info', 'Permohonan relawan ini sudah disetujui sebelumnya.');
        }

        // Generate random temporary password (e.g. relawan7482)
        $tempPassword = 'relawan' . rand(1000, 9999);

        // Check if user account already exists in users table
        $existingUser = $userModel->findByEmail($registration['whatsapp']);
        if (!$existingUser) {
            // Create new user account for approved volunteer
            $userModel->insert([
                'name' => $registration['nama'],
                'email' => $registration['whatsapp'], // WhatsApp number as username identifier
                'password_hash' => password_hash($tempPassword, PASSWORD_DEFAULT),
                'role' => 'relawan',
                'posko_id' => null,
            ]);
        } else {
            // Update password for existing user
            $userModel->update($existingUser['id'], [
                'password_hash' => password_hash($tempPassword, PASSWORD_DEFAULT),
            ]);
        }

        // Update registration status to approved
        $regModel->update($id, ['status' => 'approved']);

        // Build WhatsApp notification message with PsyAid intro & temporary credentials
        $poskoName = $registration['posko_name'] ?? 'Posko Bencana BPBD';
        $waMsg = "Halo, Sdr/i *" . $registration['nama'] . "*! \n\n";
        $waMsg .= "Kami dari *Tim PsyAid BPBD Command Center* ingin mengabarkan bahwa permohonan pendaftaran Anda sebagai *Relawan Penanggulangan Bencana* telah *DISETUJUI*!\n\n";
        $waMsg .= "Berikut adalah rincian akun relawan Anda:\n";
        $waMsg .= "1. *Posko Penugasan:* " . $poskoName . "\n";
        $waMsg .= "2. *Username (No. WA):* " . $registration['whatsapp'] . "\n";
        $waMsg .= "3. *Password Sementara:* " . $tempPassword . "\n\n";
        $waMsg .= "Silakan login ke platform PsyAid dan segera ubah password sementara Anda untuk keamanan akun. Terima kasih atas kepedulian Anda membantu sesama!";

        // Format international WhatsApp number (+62)
        $waClean = preg_replace('/\D/', '', $registration['whatsapp']);
        if (str_starts_with($waClean, '0')) {
            $waClean = '62' . substr($waClean, 1);
        }
        $waUrl = 'https://wa.me/' . $waClean . '?text=' . rawurlencode($waMsg);

        return redirect()->to('/bpbd/register-relawan')
            ->with('success', 'Permohonan relawan "' . esc($registration['nama']) . '" BERHASIL DISETUJUI! Password sementara: ' . $tempPassword)
            ->with('wa_redirect', $waUrl);
    }

    /**
     * Reject Volunteer Registration Request & Prepare WhatsApp Rejection Message
     */
    public function reject($id)
    {
        $regModel = new VolunteerRegistrationModel();
        $registration = $regModel->find($id);

        if (!$registration) {
            return redirect()->to('/bpbd/register-relawan')->with('error', 'Data permohonan relawan tidak ditemukan.');
        }

        // Update status to rejected
        $regModel->update($id, ['status' => 'rejected']);

        // Build WhatsApp rejection message with PsyAid intro
        $poskoName = $registration['posko_name'] ?? 'Posko Bencana BPBD';
        $waMsg = "Halo, Sdr/i *" . $registration['nama'] . "*! \n\n";
        $waMsg .= "Kami dari *Tim PsyAid BPBD Command Center* ingin menyampaikan permohonan maaf. Setelah dilakukan peninjauan, permohonan pendaftaran relawan Anda untuk *" . $poskoName . "* saat ini *BELUM DAPAT DISETUJUI*.\n\n";
        $waMsg .= "Terima kasih banyak atas niat baik dan antusiasme Anda untuk bergabung bersama PsyAid BPBD. Anda dapat mengajukan pendaftaran kembali pada kesempatan berikutnya. Tetap semangat!";

        // Format international WhatsApp number (+62)
        $waClean = preg_replace('/\D/', '', $registration['whatsapp']);
        if (str_starts_with($waClean, '0')) {
            $waClean = '62' . substr($waClean, 1);
        }
        $waUrl = 'https://wa.me/' . $waClean . '?text=' . rawurlencode($waMsg);

        return redirect()->to('/bpbd/register-relawan')
            ->with('info', 'Permohonan relawan "' . esc($registration['nama']) . '" telah ditolak.')
            ->with('wa_redirect', $waUrl);
    }

    /**
     * Render Psychologist Registration page for BPBD Admin
     */
    public function psikologPage()
    {
        return view('bpbd/RegisterPsikolog', [
            'title' => 'Registrasi Akun Psikolog - BPBD Command Center',
        ]);
    }

    /**
     * Process Psychologist Registration request
     */
    public function storePsikolog()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[150]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'name' => [
                'required' => 'Nama lengkap psikolog wajib diisi.',
                'min_length' => 'Nama psikolog minimal 3 karakter.',
            ],
            'email' => [
                'required' => 'Alamat email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique' => 'Email ini telah terdaftar di sistem. Silakan gunakan email lain.',
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.',
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches' => 'Konfirmasi password tidak cocok dengan password di atas.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = trim($this->request->getPost('name'));
        $email = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $userData = [
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'psikolog',
            'posko_id' => null,
        ];

        $inserted = $userModel->insert($userData);

        if (!$inserted) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftarkan akun Psikolog. Silakan coba lagi.');
        }

        return redirect()->to('/bpbd/register-psikolog')->with('success', 'Akun Psikolog Klinis "' . esc($name) . '" (' . esc($email) . ') berhasil didaftarkan!');
    }
}
