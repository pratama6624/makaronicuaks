<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->productModel = new ProductModel;
    }

    public function home(): string
    {
        $data = [
            "title" => "Beranda"
        ];

        return view('Pages/Home', $data);
    }

    public function products(): string
    {
        $data = [
            "title" => "Produk",
            "productData" => $this->productModel->getAllProductsIncludingDiscountsNoLazy()
        ];

        return view('Product/Products', $data);
    }

    public function aboutUs(): string
    {
        $data = [
            "title" => "Tentang Kami"
        ];

        return view('Pages/AboutUs', $data);
    }

    public function blog(): string
    {
        $data = [
            "title" => "Blog"
        ];

        return view('Pages/Blog', $data);
    }

    public function shoppingCart(): string
    {
        $data = [
            "title" => "Keranjang Belanja"
        ];

        return view('Product/ShoppingCart', $data);
    }

    public function account(): string
    {
        $data = [
            "title" => "Profil"
        ];

        return view('Product/Account', $data);
    }
}
