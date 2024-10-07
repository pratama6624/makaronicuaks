<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function home(): string
    {
        $data = [
            "title" => "Admin : Beranda",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Dashboard', $data);
    }

    public function orders(): string
    {
        $data = [
            "title" => "Pesanan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
        ];

        return view('Admin/Orders', $data);
    }

    public function orderComplete(): string
    {
        $data = [
            "title" => "Pesanan Selesai",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3)
        ];

        return view('Admin/OrderComplete', $data);
    }

    public function orderCancel(): string
    {
        $data = [
            "title" => "Pesanan Dibatalkan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
        ];

        return view('Admin/OrderCancel', $data);
    }

    public function products(): string
    {
        $data = [
            "title" => "Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Products', $data);
    }

    public function reports(): string
    {
        $data = [
            "title" => "Laporan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Reports', $data);
    }

    public function customers(): string
    {
        $data = [
            "title" => "Daftar Pelanggan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Customers', $data);
    }

    public function discount(): string
    {
        $data = [
            "title" => "Diskon",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Discount', $data);
    }

    public function review(): string
    {
        $data = [
            "title" => "Ulasan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Review', $data);
    }
}