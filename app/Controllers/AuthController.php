<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
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
