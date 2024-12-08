<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;

class HomeController extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->productModel = new ProductModel;
    }

    public function home(): string
    {
        $data = [
            "title" => "Beranda",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Pages/Home', $data);
    }

    public function products(): string
    {
        $filter = $this->request->getGet('filter');

        $data = [
            "title" => "Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "productData" => $this->productModel->getAllProductsIncludingDiscountsNoLazy($filter),
            "filter" => $filter
        ];

        return view('Product/Products', $data);
    }

    public function aboutUs(): string
    {
        $data = [
            "title" => "Tentang Kami",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Pages/AboutUs', $data);
    }

    public function blog(): string
    {
        $data = [
            "title" => "Blog",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Pages/Blog', $data);
    }

    public function shoppingCart(): string
    {
        $data = [
            "title" => "Keranjang Belanja",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Product/ShoppingCart', $data);
    }

    public function account(): string
    {
        $data = [
            "title" => "Profil",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Product/Account', $data);
    }
}
