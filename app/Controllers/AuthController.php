<?php

namespace App\Controllers;

use App\Models\PoskoModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    /**
     * Show Registration Form
     */
    public function register()
    {
        if (session()->get('logged_in')) {
            return $this->redirectUserByRole(session()->get('role'), session()->get('posko_id'));
        }

        return view('auth/register', [
            'hideNavbar' => true,
        ]);
    }

    /**
     * Process Registration Request for Admin BPBD
     */
    public function attemptRegister()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[150]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        $messages = [
            'name' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.',
            ],
            'email' => [
                'required'    => 'Alamat email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email ini sudah terdaftar di sistem. Silakan gunakan email lain atau login.',
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
            'role'          => 'bpbd_admin',
            'posko_id'      => null,
        ];

        $inserted = $userModel->insert($userData);

        if (! $inserted) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftarkan akun Admin BPBD. Silakan coba lagi.');
        }

        return redirect()->to('/login')->with('success', 'Registrasi akun Admin BPBD berhasil! Silakan masuk.');
    }

    /**
     * Show Login Form
     */
    public function login()
    {
        // If already logged in, redirect to user dashboard
        if (session()->get('logged_in')) {
            return $this->redirectUserByRole(session()->get('role'), session()->get('posko_id'));
        }

        return view('auth/login', ['hideNavbar' => true]);
    }

    /**
     * Process Login Request
     */
    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->findByEmail($email);

        if (! $user) {
            return redirect()->back()->withInput()->with('error', 'Email tidak terdaftar.');
        }

        if (! password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah.');
        }

        // Set session data
        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'posko_id'  => $user['posko_id'],
            'logged_in' => true,
        ]);

        return $this->redirectUserByRole($user['role'], $user['posko_id'])
            ->with('success', 'Selamat datang kembali, ' . $user['name']);
    }

    /**
     * Destroy session and logout
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Render 403 Forbidden page
     */
    public function forbidden()
    {
        return response()->setStatusCode(403)->setBody(view('auth/403'));
    }

    /**
     * Helper redirect based on role
     */
    private function redirectUserByRole(string $role, ?int $poskoId)
    {
        switch ($role) {
            case 'bpbd_admin':
                return redirect()->to('/command-center');
            case 'relawan':
                $targetPosko = $poskoId ?? 1;
                return redirect()->to('/relawan/posko/' . $targetPosko);
            case 'psikolog':
                return redirect()->to('/psikolog/dashboard');
            default:
                return redirect()->to('/login');
        }
    }
}
