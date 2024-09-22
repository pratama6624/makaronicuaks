<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function home(): string
    {
        $data = [
            "title" => "Beranda"
        ];

        return view('Pages/Home', $data);
    }
}
