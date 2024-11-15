<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'product_name', 'description', 'price', 'flavor', 'stock', 'image', 'category', 'weight', 'discount_status', 'discount_amount', 'created_at', 'updated_at', 'is_deleted'
    ];

    public function getProductByID($idProduct)
    {
        return $this->where('id_product', $idProduct)->first();
    }

    public function getAllProduct()
    {
        return $this->findAll();
    }
}