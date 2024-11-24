<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;
use App\Models\Product as ProductModel;
use App\Models\Recovery as RecoveryModel;
use App\Models\DiscountEvent as DiscountEventModel;

class AdminController extends BaseController
{
    protected $request;
    protected $validation;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->authModel = new AuthModel;
        $this->productModel = new ProductModel;
        $this->recoveryModel = new RecoveryModel;
        $this->discountEvent = new DiscountEventModel;
        $this->validation = \Config\Services::validation();
    }

    public function home(): string
    {
        $data = [
            "title" => "Admin : Beranda",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Dashboard', $data);
    }

    public function orders(): string
    {
        $data = [
            "title" => "Pesanan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
        ];

        return view('Admin/Orders', $data);
    }

    public function orderComplete(): string
    {
        $data = [
            "title" => "Pesanan Selesai",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3)
        ];

        return view('Admin/OrderComplete', $data);
    }

    public function orderCancel(): string
    {
        $data = [
            "title" => "Pesanan Dibatalkan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(3),
        ];

        return view('Admin/OrderCancel', $data);
    }

    public function products(): string
    {
        session()->set('referer', current_url());

        $data = [
            "title" => "Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "productData" => $this->productModel->getAllProductsIncludingDiscounts()
        ];

        // dd($data['productData']);

        return view('Admin/Products', $data);
    }

    public function detailProduct($encryptId): String
    {
        $decryptId = decrypt($encryptId);

        $referer = session()->get('referer') ?? site_url('admin/products');

        $data = [
            "title" => "Detail Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "productDetailData" => $this->productModel->getProductIncludingDiscountByID($decryptId),
            "backUrl" => $referer
        ];

        return view('Admin/DetailProduct', $data);
    }

    public function addProduct(): string
    {
        $data = [
            "title" => "Tambah Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/AddProduct', $data);
    }

    public function editProduct($encryptId): string
    {
        $decryptId = decrypt($encryptId);

        $data = [
            "title" => "Edit Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "productDetailData" => $this->productModel->getProductByID($decryptId),
            "idProduct" => $encryptId
        ];

        return view('Admin/EditProduct', $data);
    }

    public function saveProduct()
    {
        $product_data = [
            "product_name" => $this->request->getPost("product_name"),
            "price" => $this->request->getPost("price"),
            "flavor" => $this->request->getPost("flavor"),
            "stock" => $this->request->getPost("stock"),
            "category" => $this->request->getPost("category") == NULL ? "Camilan" : $this->request->getPost("category"),
            "weight" => $this->request->getPost("weight"),
            "discount_status" => $this->request->getPost("discount_status") == "Tidak sedang diskon" ? 0 : 1,
            "discount_amount" => $this->request->getPost("discount_amount") == "" ? 0.0 : (float)$this->request->getPost("discount_amount"),
            "discount_note" => $this->request->getPost("discount_note"),
            "description" => $this->request->getPost("description") == NULL ? "" : $this->request->getPost("description"),
            "product_image" => $this->request->getFile("product_image")
        ];

        $this->validation->setRules([
            "product_name" => [
                "rules" => "required|max_length[50]|is_unique[products.product_name]",
                "errors" => [
                    "required" => "Nama produk wajib diisi",
                    "is_unique" => "Nama produk sudah ada",
                    "max_length" => "Nama produk tidak boleh lebih dari 50 karakter"
                ]
            ],
            "price" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harga produk wajib diisi",
                ]
            ],
            "flavor" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Rasa produk wajib diisi",
                ]
            ],
            "stock" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Stok minimal 1",
                ]
            ],
            "product_image" => [
                "rules" => "mime_in[product_image,image/jpg,image/jpeg,image/png]|max_size[product_image,2048]",
                "errors" => [
                    "mime_in" => "Format gambar harus JPG, JPEG, atau PNG",
                    "max_size" => "Ukuran gambar tidak boleh lebih dari 2MB"
                ]
            ]
        ]);

        if(!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to('admin/products/add')->withInput()->with('validation', $this->validation->getErrors());
        }

        $imageName = $product_data["product_image"]->getRandomName();

        $destinationPath = 'assets/images/products/';

        if(!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        if (!$product_data["product_image"]->move($destinationPath, $imageName)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memindahkan file ke folder tujuan.'
            ]);
        }

        $this->productModel->save([
            "product_name" => $product_data["product_name"],
            "description" => $product_data["description"],
            "price" => $product_data["price"],
            "flavor" => $product_data["flavor"],
            "stock" => $product_data["stock"],
            "image" => $imageName,
            "category" => $product_data["category"],
            "weight" => $product_data["weight"],
            "discount_status" => $product_data["discount_status"],
            "discount_amount" => $product_data["discount_amount"],
            "discount_note" => $product_data["discount_note"],
            'is_deleted' => 0
        ]);

        return redirect()->to('admin/products')->withInput()->with('success', "Data berhasil ditambahkan");
    }

    public function deleteProduct($encryptId)
    {
        $decryptId = decrypt($encryptId);


        print($decryptId);
    }

    public function reports(): string
    {
        $data = [
            "title" => "Laporan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Reports', $data);
    }

    public function customers(): string
    {
        $data = [
            "title" => "Daftar Pelanggan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "activeCustomers" => $this->authModel->getAllCustomers(0, 1),
            "inActiveCustomers" => $this->authModel->getAllCustomers(0, 0),
            "deletedCustomers" => $this->authModel->getDeletedCustomers(1),
            "requestRecoveryCustomers" => $this->recoveryModel->getUsers()
        ];

        return view('Admin/Customers', $data);
    }

    public function discountEvent(): string
    {
        $data = [
            "title" => "Diskon",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "discountEventData" => $this->discountEvent->getAllDiscountEvent()
        ];

        return view('Admin/DiscountEvent', $data);
    }

    public function detailDiscountEvent($encryptId): String
    {
        session()->set('referer', current_url());

        $decryptId = decrypt($encryptId);

        $data = [
            "title" => "Detail Diskon Event",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "discountEventData" => $this->discountEvent->getDiscountEventByID($decryptId),
            "discountEventProductData" => $this->discountEvent->getProductDiscountEvent($decryptId)
        ];

        return view('Admin/DetailDiscountEvent', $data);
    }

    public function addDiscountEvent(): string
    {
        $data = [
            "title" => "Tambah Diskon Event",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/AddDiscountEvent', $data);
    }

    public function saveDiscountEvent()
    {
        $discount_event_data = [
            "event_name" => $this->request->getPost("event_name"),
            "event_start_date" => $this->request->getPost("event_start_date"),
            "event_end_date" => $this->request->getPost("event_end_date"),
            "precentage" => $this->request->getPost("precentage"),
            "event_description" => $this->request->getPost("event_description"),
        ];

        $this->validation->setRules([
            "event_name" => [
                "rules" => "required|max_length[30]|is_unique[discount_events.name]",
                "errors" => [
                    "required" => "Nama event wajib diisi",
                    "is_unique" => "Nama event sudah ada",
                    "max_length" => "Nama event tidak boleh lebih dari 30 karakter"
                ]
            ],
            "event_start_date" => [
                "rules" => "required|valid_date[Y-m-d]",
                "errors" => [
                    "required" => "Event mulai wajib diisi",
                    "valid_date" => "Format tanggal mulai tidak valid"
                ]
            ],
            "event_end_date" => [
                "rules" => "required|valid_date[Y-m-d]",
                "errors" => [
                    "required" => "Event berakhir wajib diisi",
                    "valid_date" => "Format tanggal berakhir tidak valid"
                ]
            ],
            "precentage" => [
                "rules" => "required|greater_than_equal_to[0.1]",
                "errors" => [
                    "required" => "Diskon wajib diisi",
                    "greater_than_equal_to" => "Diskon minimal adalah 0.1%"
                ]
            ],
        ]);
        
        $is_valid = $this->validation->withRequest($this->request)->run();

        $errors = $this->validation->getErrors();

        $start_date = strtotime($discount_event_data['event_start_date']);
        $end_date = strtotime($discount_event_data['event_end_date']);

        if ($end_date < $start_date) {
            $errors['event_end_date'] = "Harus lebih besar atau sama dengan tanggal mulai";
        }

        if (!empty($errors)) {
            return redirect()->to('/admin/add_discount_event')->withInput()->with('validation', $errors);
        }
        
        // Lolos validasi
        
        $this->discountEvent->save([
            "name" => $discount_event_data["event_name"],
            "start_date" => $discount_event_data["event_start_date"],
            "end_date" => $discount_event_data["event_end_date"],
            "description" => $discount_event_data["event_description"],
            "precentage" => $discount_event_data["precentage"],
        ]);

        return redirect()->to('/admin/add_discount_event')->with('success', "Data berhasil ditambahkan");
    }

    public function discount(): string
    {
        session()->set('referer', current_url());

        $data = [
            "title" => "Diskon",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "productData" => $this->productModel->getProductDiscount()
        ];

        return view('Admin/Discount', $data);
    }

    public function review(): string
    {
        $data = [
            "title" => "Ulasan",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
        ];

        return view('Admin/Review', $data);
    }
}