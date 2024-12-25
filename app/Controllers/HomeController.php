<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;
use App\Models\ShoppingCart as CartModel;
use App\Models\DiscountEvent as DiscountEventModel;

class HomeController extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->productModel = new ProductModel;
        $this->cartModel = new CartModel;
        $this->discountEvent = new DiscountEventModel;
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

    public function event(): string
    {
        $filter = $this->request->getGet('filter');

        $data = [
            "title" => "Event",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : [],
            "eventData" => $this->discountEvent->getAllDiscountEventWithFilter($filter),
            "filter" => $filter
        ];

        return view('Pages/Event', $data);
    }

    public function eventProduct(): string
    {
        $id = $this->request->getGet('id');

        $data = [
            "title" => "Event Product",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
            "cartItemCount" => session()->has('user') ? $this->cartModel->countAllProductsByUserId(session()->get("user")["id"])["total_quantity"] : [],
            "eventProductData" => $this->discountEvent->getProductDiscountEvent($id)
        ];

        // dd($data["eventProductData"]);

        return view('Pages/EventProduct', $data);
    }

    public function shoppingCart(): string
    {
        // dd($this->cartModel->getAllProductsIncludingDiscountByCart(3));
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
        // SKENARIO LOGIN UNTUK PENGGABUNGAN SESSION CART DENGAN DATABASE CART

        /* 
            1. JIKA PADA SAAT AKAN LOGIN, SESSION CART DAN DATABASE CART SAMA" KOSONG
               MAKA JANGAN LAKUKAN APAPUN
            2. JIKA PADA SAAT AKAN LOGIN, SESSION CART KOSONG DAN DATABASE CART TERISI
               MAKA JANGAN LAKUKAN APAPUN
            3. JIKA PADA SAAT AKAN LOGIN, SESSION CART TERISI DAN DATABASE CART KOSONG
               MAKA LANGSUNG MASUKAN SESSION KE DATABASE DAN HAPUS SESSION
            4. JIKA PADA SAAT AKAN LOGIN, SESSION CART DAN DATABASE CART SAMA" TERISI
               AKAN TETAPI MEMILIKI LIST DATA YANG BERBEDA
               MAKA AMBIL KEDUA SUMBER LALU GABUNGKAN DAN UPDATE DATABASE CART
        */
        $userId = session()->get('user')['id'];
        $sessionCart = session()->get('cart');
        $dbCart = $this->cartModel->getAllCartByUserId($userId);

        if($sessionCart == null && $dbCart == null || $sessionCart == null && $dbCart != null) {
            // SKENARIO 1 + SKENARIO 2
            return redirect()->to("");
        } else if($sessionCart != null && $dbCart == null) {
            // SKENARIO 3
            $data = $this->sessionCartToDbCartFormat($sessionCart, $userId);
            $this->cartModel->insertBatch($data);

            return redirect()->to("");
        } else if($sessionCart != null && $dbCart != null) {
            //SKENARIO 4
            $data = $this->sessionCartToDbCartFormat($sessionCart, $userId);
            $this->mergeAndSaveCarts($data, $dbCart, $userId);

            return redirect()->to("");
        }
    }

    public function mergeAndSaveCarts($sessionCart, $dbCart, $userId)
    {
        // SKENARI MERGE DATA JIKA SESSION CART DAN DATABASE CART SAMA" BERISI TETAPI DENGAN LIST DATA BERBEDA
        /*
            1. JIKA ID CART SUDAH ADA MAKA UPDATE
            2. JIKA ID CART TIDAK ADA MAKA INSERT
        */

        $mergedData = [];

        foreach ($dbCart as $item) {
            $mergedData[$item['product_id']] = $item;
        }

        foreach ($sessionCart as $item) {
            $productId = $item['product_id'];

            if (isset($mergedData[$productId])) {
                // Jika product_id sudah ada di database, tambahkan quantity
                $mergedData[$productId]['quantity'] += $item['quantity'];
            } else {
                // Jika product_id belum ada di database, tambahkan sebagai item baru
                $item['id_cart'] = null; // Tandai sebagai item baru (tidak ada id_cart)
                $mergedData[$productId] = $item;
            }
        }

        foreach ($mergedData as $item) {
            // Tentukan apakah ini update atau insert berdasarkan id_cart
            if (isset($item['id_cart']) && $item['id_cart'] !== null) {
                // Update jika id_cart sudah ada
                $this->cartModel->update($item['id_cart'], $item);
            } else {
                // Insert jika id_cart tidak ada
                unset($item['id_cart']); // Pastikan id_cart tidak dikirim saat insert
                $this->cartModel->insert($item);
            }
        }
    }

    public function sessionCartToDbCartFormat($sessionCart, $userId)
    {
        $result = [];
        
        foreach($sessionCart as $productId => $quantity) {
            $result[] = [
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ];
        }

        return $result;
    }

    public function updateQuantity()
    {
        if ($this->request->getMethod() === 'POST') {
            $productId = $this->request->getJSON()->product_id;
            $quantity = $this->request->getJSON()->quantity;

            if ($quantity <= 0) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Quantity must be greater than 0']);
            }

            // Update quantity di database
            $this->cartModel->where('product_id', $productId)
                ->set(['quantity' => $quantity])
                ->update();

            // Ambil data produk yang diperbarui termasuk total harga dan diskon
            $product = $this->cartModel->getAllProductsIncludingDiscountByCart(3);

            // Hitung total belanja keseluruhan
            $price = 0;
            $priceOfThisProduct = 0;
            $totalAmount = 0;
            foreach ($product as $item) {
                $price = $this->calculatePrice($item);

                if($item["id_product"] == $productId) {
                    $priceOfThisProduct = $price;
                }

                $totalAmount += $price * $item['quantity'];
            }

            return $this->response->setJSON([
                'status' => 'success',
                'product' => [
                    'id_product' => $productId,
                    'total_price' => $priceOfThisProduct * $quantity,
                    'quantity' => $quantity,
                ],
                'total_amount' => $totalAmount,
            ]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request method']);
        }
    
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }

    // Fungsi untuk menghitung harga berdasarkan diskon
    private function calculatePrice($item) {
        if ($item["discount_status"] != 0) {
            return $item['price'] - ($item['price'] * ($item['discount_amount']) / 100);
        } elseif ($item["id_discount"] != null) {
            return $item['price'] - ($item['price'] * ($item['precentage']) / 100);
        } else {
            return $item["price"];
        }
    }

    public function calculateTotal() {
        $cart = $this->cartModel->getProductIncludingDiscountByID(3);
        $total = 0;
    
        foreach ($cart as $item) {
            // PRICE DISINI GA ADA KARNA GA ADA RELASI ANTARA CART X PRODUCT
            /* 
                dan kalopun sudah di relasikan
                akan muncul masalah baru
                dimana disini akan ada percabangan untuk cek
                jika ada discount by personal / event
            */
            $total += $item['price'] * $item['quantity'];
        }
    
        return $total;
    }

    public function deleteCartItem()
    {
        if ($this->request->getMethod() === 'POST') {
            $productId = $this->request->getJSON()->product_id;

            // Validasi jika product_id ada di cart user
            $this->cartModel->deleteByProductId($productId);

            return $this->response->setJSON(['status' => 'success', 'message' => 'Item deleted successfully']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete item']); 

        throw new \CodeIgniter\Exceptions\PageNotFoundException();
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