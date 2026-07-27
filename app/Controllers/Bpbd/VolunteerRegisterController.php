<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use App\Models\UserModel;

class VolunteerRegisterController extends BaseController
{
    /**
     * Render Volunteer Registration page for BPBD Admin
     */
    public function index()
    {
        return view('bpbd/RegisterRelawan', [
            'title' => 'Registrasi Akun Relawan - BPBD Command Center',
        ]);
    }

    /**
     * Process Volunteer Registration request using WhatsApp number
     */
    public function store()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[150]',
            'whatsapp'         => 'required|numeric|min_length[9]|max_length[20]|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'name' => [
                'required'   => 'Nama lengkap relawan wajib diisi.',
                'min_length' => 'Nama relawan minimal 3 karakter.',
            ],
            'whatsapp' => [
                'required'   => 'Nomor WhatsApp wajib diisi.',
                'numeric'    => 'Nomor WhatsApp harus berupa angka (contoh: 081234567890).',
                'min_length' => 'Nomor WhatsApp minimal 9 digit.',
                'max_length' => 'Nomor WhatsApp maksimal 20 digit.',
                'is_unique'   => 'Nomor WhatsApp ini sudah terdaftar di sistem.',
            ],
            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.',
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak cocok dengan password di atas.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name     = trim($this->request->getPost('name'));
        $whatsapp = trim($this->request->getPost('whatsapp'));
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $userData  = [
            'name'          => $name,
            'email'         => $whatsapp, // Store WhatsApp number in user identifier (email column)
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => 'relawan',
            'posko_id'      => null, // Unassigned by default
        ];

        $inserted = $userModel->insert($userData);

        if (! $inserted) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftarkan akun Relawan. Silakan coba lagi.');
        }

        return redirect()->to('/bpbd/register-relawan')->with('success', 'Akun Relawan "' . esc($name) . '" dengan WhatsApp ' . esc($whatsapp) . ' berhasil didaftarkan!');
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
            'name'             => 'required|min_length[3]|max_length[150]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'name' => [
                'required'   => 'Nama lengkap psikolog wajib diisi.',
                'min_length' => 'Nama psikolog minimal 3 karakter.',
            ],
            'email' => [
                'required'    => 'Alamat email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email ini telah terdaftar di sistem. Silakan gunakan email lain.',
            ],
            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.',
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak cocok dengan password di atas.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name     = trim($this->request->getPost('name'));
        $email    = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $userData  = [
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => 'psikolog',
            'posko_id'      => null,
        ];

        $inserted = $userModel->insert($userData);

        if (! $inserted) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftarkan akun Psikolog. Silakan coba lagi.');
        }

        return redirect()->to('/bpbd/register-psikolog')->with('success', 'Akun Psikolog Klinis "' . esc($name) . '" (' . esc($email) . ') berhasil didaftarkan!');
    }
}
