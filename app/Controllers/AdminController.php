<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;
use App\Models\Product as ProductModel;
use App\Models\Recovery as RecoveryModel;

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
        $data = [
            "title" => "Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "productData" => $this->productModel->getAllProduct()
        ];

        return view('Admin/Products', $data);
    }

    public function detailProduct($encryptId): String
    {
        $decryptId = decrypt($encryptId);

        $data = [
            "title" => "Detail Produk",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
            "productDetailData" => $this->productModel->getProductByID($decryptId)
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
            "productDetailData" => $this->productModel->getProductByID($decryptId)
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
            "description" => $this->request->getPost("description") == NULL ? "" : $this->request->getPost("description"),
            "product_image" => $this->request->getFile("product_image")
        ];

        if (!$product_data["product_image"] || !$product_data["product_image"]->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'File tidak valid atau tidak ditemukan.'
            ]);
        }

        $validationRules = [
            'uploaded[product_image]',
            'mime_in[product_image,image/jpg,image/jpeg,image/png]',
            'max_size[product_image,2048]', // Ukuran maksimum 2MB
        ];
    
        if (!$this->validate(['image' => $validationRules])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'File harus berupa gambar JPG, JPEG, atau PNG dengan ukuran maksimal 2MB.'
            ]);
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

        $this->validation->setRules([
            "product_name" => [
                "rules" => "required|max_length[50]|is_unique[products.product_name]",
                "errors" => [
                    "required" => "Nama produk wajib diisi",
                    "is_unique" => "Nama produk sudah ada",
                    "max_length" => "Nama produk tidak boleh lebih dari 50 karakter"
                ]
            ],
            "flavor" => [
                "rules" => "required|max_length[50]",
                "errors" => [
                    "required" => "Rasa produk wajib diisi",
                    "max_length" => "Rasa produk tidak boleh lebih dari 50 karakter"
                ]
            ],
        ]);

        if(!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to('admin/products/add')->withInput()->with('validation', $this->validation->getErrors());
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

    public function discount(): string
    {
        $data = [
            "title" => "Diskon",
            "sideMenuTitle" => $this->request->getUri()->getSegment(2),
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