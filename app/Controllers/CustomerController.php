<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;
use App\Models\Recovery as RecoveryModel;

class CustomerController extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel;
        $this->recoveryModel = new RecoveryModel;
    }

    public function activeCustomers(): string
    {
        $data = [
            "title" => "Daftar Pelanggan Aktif",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
            "activeCustomers" => $this->authModel->getAllCustomers(0, 1),
        ];

        return view('Customer/ActiveCustomers', $data);
    }

    public function inActiveCustomers(): string
    {
        $data = [
            "title" => "Daftar Pelanggan Belum Aktif",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
            "inActiveCustomers" => $this->authModel->getAllCustomers(0, 0),
        ];

        return view('Customer/InActiveCustomers', $data);
    }

    public function deletedCustomers(): string
    {
        $data = [
            "title" => "Daftar Pelanggan Dihapus",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
            "deletedCustomers" => $this->authModel->getDeletedCustomers(1),
        ];

        return view('Customer/DeletedCustomers', $data);
    }

    public function recovery(): string
    {
        $data = [
            "title" => "Daftar Pemulihan Pelanggan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
            "requestRecoveryCustomers" => $this->recoveryModel->getUsers()
        ];

        return view('Customer/Recovery', $data);
    }
}