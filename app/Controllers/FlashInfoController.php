<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FlashInfoController extends BaseController
{

    public function newProductInfo(): string
    {
        $data = [
            "title" => "Admin : Produk Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoNewProduct', $data);
    }

    public function stockInfo(): string
    {
        $data = [
            "title" => "Admin : Stok Menipis",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoStock', $data);
    }

    public function newEventInfo(): string
    {
        $data = [
            "title" => "Admin : Produk Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoNewEvent', $data);
    }

    public function newUser(): string
    {
        $data = [
            "title" => "Admin : Pengguna Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoNewUser', $data);
    }

    public function newOrder(): string
    {
        $data = [
            "title" => "Admin : Pengguna Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoNewOrder', $data);
    }

    public function newCancelOrder(): string
    {
        $data = [
            "title" => "Admin : Pengguna Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoNewCancelOrder', $data);
    }

    public function totalSales(): string
    {
        $data = [
            "title" => "Admin : Pengguna Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoTotalSales', $data);
    }

    public function totalValue(): string
    {
        $data = [
            "title" => "Admin : Pengguna Baru",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('FlashInfo/FlashInfoTotalValue', $data);
    }
}