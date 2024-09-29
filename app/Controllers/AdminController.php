<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function home(): string
    {
        $data = [
            "title" => "Admin : Beranda"
        ];

        return view('Admin/Dashboard', $data);
    }

    public function orders(): string
    {
        $data = [
            "title" => "Pesanan"
        ];

        return view('Admin/Orders', $data);
    }

    public function orderComplete(): string
    {
        $data = [
            "title" => "Pesanan Selesai"
        ];

        return view('Admin/OrderComplete', $data);
    }

    public function orderCancel(): string
    {
        $data = [
            "title" => "Pesanan Dibatalkan"
        ];

        return view('Admin/OrderCancel', $data);
    }

    public function products(): string
    {
        $data = [
            "title" => "Produk"
        ];

        return view('Admin/Products', $data);
    }

    public function reports(): string
    {
        $data = [
            "title" => "Laporan"
        ];

        return view('Admin/Reports', $data);
    }
}