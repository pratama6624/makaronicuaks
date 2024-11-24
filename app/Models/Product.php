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
        'product_name', 'description', 'price', 'flavor', 'stock', 'image', 'category', 'weight', 'discount_status', 'discount_amount', 'discount_note', 'created_at', 'updated_at', 'is_deleted'
    ];

    protected $selectFields = [
            'discount_events.id_discount',
            'discount_events.name',
            'discount_events.start_date',
            'discount_events.end_date',
            'discount_events.precentage',
            'products.id_product',
            'products.product_name',
            'products.price',
            'products.flavor',
            'products.stock',
            'products.image',
            'products.category',
            'products.weight',
            'products.discount_status',
            'products.discount_amount',
            'products.discount_note',
            'products.description'
    ];

    public function getProductIncludingDiscountByID($idProduct)
    {
        return $this->select($this->selectFields)
        ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
        ->where("id_product", $idProduct)
        ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
        ->first();
    }

    public function getAllProductsIncludingDiscounts()
    {
        return $this->select($this->selectFields)
        ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
        ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
        ->get()
        ->getResultArray();
    }

    public function getProductDiscount()
    {
        return $this->where('discount_status', 1)->findAll();
    }
}