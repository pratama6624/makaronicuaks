<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;

class AuthController extends BaseController
{
    protected $request;
    protected $authModel;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->authModel = new AuthModel;
    }

    public function login(): string
    {
        $data = [
            "title" => "Login"
        ];

        dd($this->authModel->getUsers());

        return view('Auth/Login', $data);
    }

    public function register(): string
    {
        $data = [
            "title" => "Login"
        ];

        return view('Auth/Register', $data);
    }
}