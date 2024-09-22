<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function login(): string
    {
        $data = [
            "title" => "Login"
        ];

        return view('Auth/Login', $data);
    }
}