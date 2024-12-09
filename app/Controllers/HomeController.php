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
        $cartData;
        if(session()->has('cart')) {
            $cartSession = session()->get('cart');
            $cartData = $this->productModel->getAllProductCarts(array_keys($cartSession));
            
            foreach ($cartData as &$product) {
                $product['quantity'] = $cartSession[$product['id_product']] ?? 0;
            }
        } else {
            $cartData = [];
        }

        $data = [
            "title" => "Keranjang Belanja",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartData" => $cartData
        ];

        // JIKA SUDAH LOGIN MAKA SIMPAN ATAU PERBARUI DATA KE DATABASE DARI SESSION "CART"
        // JIKA BELUM LOGIN MAKAN SIMPAN DAN AMBIL DATA DARI SESSION "CART" SAJA

        return view('Product/ShoppingCart', $data);
    }

    public function addToCart()
    {
        $productId = $this->request->getPost('id_product');
        $quantity = $this->request->getPost("quantity", FILTER_VALIDATE_INT);

        $cart = session()->get('cart') ?? [];

        if(!$productId || !$quantity || $quantity <= 0) {
            return $this->response->setJSON([
                'status' => "error",
                'message' => "Invalid data"
            ])->setStatusCode(400);
        }

        $isLoggedIn = session()->get('user');

        if($isLoggedIn) {
            // $cartModel = new 
        } else {        
            // Tambahkan produk ke keranjang
            if (isset($cart[$productId])) {
                $cart[$productId] += $quantity;
            } else {
                $cart[$productId] = $quantity;
            }

            // Simpan kembali ke session
            session()->set('cart', $cart);
        }

        return $this->response->setJSON([
            'status' => "success",
            'message' => "Produk ditambahkan ke keranjang belanja (session)",
            'cart' => $cart // Kirim data keranjang sebagai respons
        ]);
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