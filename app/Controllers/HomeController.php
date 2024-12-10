<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;
use App\Models\ShoppingCart as CartModel;

class HomeController extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->productModel = new ProductModel;
        $this->cartModel = new CartModel;
    }

    public function home(): string
    {
        $data = [
            "title" => "Beranda",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : []
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
            "filter" => $filter,
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : []
        ];

        return view('Product/Products', $data);
    }

    public function aboutUs(): string
    {
        $data = [
            "title" => "Tentang Kami",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : []
        ];

        return view('Pages/AboutUs', $data);
    }

    public function blog(): string
    {
        $data = [
            "title" => "Blog",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : []
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

        if(session()->has('user')) {
            $data = $this->cartModel->getAllProductsIncludingDiscountByCart(session()->get("user")["id"]);
            $cartData = $data;
            $shoppingSummary = $this->getFinalPriceProductListAfterDiscount($data);
            $totalAmount = $this->calculateTotalPrice($shoppingSummary);
        } else {
            $shoppingSummary = $this->getFinalPriceProductListAfterDiscount($cartData);
            $totalAmount = $this->calculateTotalPrice($shoppingSummary);
        }

        // LINK CHECKOUT BELUM DIPERBARUI
        // SINKRONISASI ANTARA SESSION CART DENGAN DATABASE SETELAH LOGIN BELUM DIBUAT

        $data = [
            "title" => "Keranjang Belanja",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartData" => $cartData,
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : [],
            "shoppingSummary" => $shoppingSummary,
            "totalAmount" => $totalAmount
        ];

        return view('Product/ShoppingCart', $data);
    }

    public function getFinalPriceProductListAfterDiscount($data)
    {
        $finalPrices = [];

        foreach ($data as $product) {
            $price = (float)$product["price"];
            
            if (!is_null($product["id_discount"])) {
                // Jika id_discount tidak null, gunakan precentage
                $discountPercentage = (float)$product["precentage"];
                $price -= ($price * $discountPercentage / 100);
            } elseif ($product["discount_status"] == "1") {
                // Jika discount_status = 1, gunakan discount_amount
                $discountPercentage = (float)$product["discount_amount"];
                $price -= ($price * $discountPercentage / 100);
            }
            
            // Tambahkan harga final ke array
            $finalPrices[] = [
                "product_id" => session()->has('user') ? $product["product_id"] : 0,
                "product_name" => $product["product_name"],
                "final_price" => round($price, 2),
                "quantity" => $product["quantity"],
                "total_price" => round($price * $product["quantity"], 2) // Harga total per produk
            ];
        }

        return $finalPrices;
    }

    function calculateTotalPrice($cartData) {
        $grandTotal = 0;

        foreach ($cartData as $product) {
            // Tambahkan total_price dari setiap produk ke grandTotal
            $grandTotal += (float)$product["total_price"];
        }

        return round($grandTotal, 2);
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
            $exist = $this->cartModel->getCartByProductId($productId);

            if($exist != null) {
                $this->cartModel->save([
                    'id_cart' => $exist["id_cart"],
                    'user_id' => $exist["user_id"],
                    'product_id' => $exist["product_id"],
                    'quantity' => $exist["quantity"] + $quantity
                ]);
            } else {
                $this->cartModel->save([
                    'user_id' => session()->get("user")["id"],
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }

            return $this->response->setJSON([
                'status' => "success",
                'message' => "Produk ditambahkan ke keranjang belanja (session)",
                'cart' => $cart // Kirim data keranjang sebagai respons
            ]);
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

    public function afterLoginSyncCart($userId)
    {

    }

    public function account(): string
    {
        $data = [
            "title" => "Profil",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : []
        ];

        return view('Product/Account', $data);
    }
}