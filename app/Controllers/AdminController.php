<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;
use App\Models\Recovery as RecoveryModel;

class AdminController extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->authModel = new AuthModel;
        $this->recoveryModel = new RecoveryModel;
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
            "activeCustomers" => $this->authModel->getAllCustomers(0, 1),
            "inActiveCustomers" => $this->authModel->getAllCustomers(0, 0),
            "deletedCustomers" => $this->authModel->getDeletedCustomers(1),
            "requestRecoveryCustomers" => $this->recoveryModel->getUsers()
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