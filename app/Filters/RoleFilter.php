<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek sesi user sebelum melakukan akses ke controller
        $user = session()->get('user');

        // Jika tidak ada sesi maka lempar ke halaman login
        if(!$user) {
            return redirect()->to("login");
        }

        // Ambil dari url dan pisahkan untuk halaman admin
        $segment = $request->getUri()->getSegment(1);

        // Filter berdasarkan level user (0 adalah user dan 1 adalah admin)
        if($segment === "admin") {
            if($user["role"] != 1) {
                // Jika bukan admin maka akses halaman admin dilarang
                return redirect()->to("/")->with("error", "Anda tidak memiliki akses ke halaman ini");
            }
        } else {
            if($user["role"] != 0) {
                return redirect()->to("admin/home")->with("error", "Anda tidak memiliki akses ke halaman ini");
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan khusus setelah respons
    }
}