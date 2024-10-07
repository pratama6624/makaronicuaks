<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoggedInFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek sesi login untuk user
        $user = session()->get('user');

        // Jika user sudah login, cek role dan arahkan ke halaman yang sesuai
        if ($user) {
            // Jika role user adalah 'admin', arahkan ke halaman dashboard admin
            if ($user['role'] == 1) {
                return redirect()->to('/admin/home')->with('info', 'Anda sudah login sebagai admin.');
            }
            
            // Jika role user adalah 'user', arahkan ke halaman home user
            if ($user['role'] == 0) {
                return redirect()->to('/')->with('info', 'Anda sudah login sebagai user.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah respons
    }
}