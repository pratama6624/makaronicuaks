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
            'products.description',
            "CONCAT('/admin/product/detail/', products.id_product) as partial_url"
    ];

    public function getProductIncludingDiscountByID($idProduct)
    {
        return $this->select($this->selectFields)
        ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
        ->where("id_product", $idProduct)
        ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
        ->first();
    }

    public function getAllProductsIncludingDiscounts($limit, $offset)
    {
        return $this->select($this->selectFields)
        ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
        ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
        ->findAll($limit, $offset);
    }

    public function getAllProductsIncludingDiscountsNoLazy($filter = "recomendation")
    {
        $allowedSortColumns = [
            'recomendation' => 'products.price ASC', // Misalnya kolom recommendation_score
            'price_asc' => 'products.price ASC',
            'price_desc' => 'products.price DESC',
            'discount' => "
                    IF(discount_events.precentage IS NOT NULL, discount_events.precentage,
                    IF(discount_events.id_discount IS NOT NULL, 0, -1)
                ) DESC
            "
        ];
    
        $sortColumn = isset($allowedSortColumns[$filter]) ? $allowedSortColumns[$filter] : $allowedSortColumns['recomendation'];

        return $this->select($this->selectFields)
        ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
        ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
        ->orderBy($sortColumn, '', false)
        ->findAll();
    }

    public function searchAllProductsIncludingDiscounts($searchQuery, $limit, $offset)
    {
        $productData;

        if($searchQuery) {
            $productData = $this->select($this->selectFields)
            ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
            ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
            ->like('products.product_name', $searchQuery)
            ->orLike('products.description', $searchQuery)
            ->orLike('products.category', $searchQuery)
            ->orLike('products.flavor', $searchQuery)
            ->findAll($limit, $offset);
        } else {
            $productData = $this->getAllProductsIncludingDiscounts($limit, $offset);
        }

        // BESOK CEK BAGIAN LOGIKA DI JS KARENA TIDAK SESUAI DENGAN YANG DI PHP, KARENA HASILNYA BEDA BAHKAN JIDA SEMUA PRODUK DITAMPILKAN
        
        return $productData;
    }

    public function getAllProductCarts($productIds)
    {
        return $this->select($this->selectFields)
        ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
        ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
        ->whereIn('id_product', $productIds)
        ->findAll();
    }

    public function getProductDiscount()
    {
        return $this->where('discount_status', 1)->findAll();
    }
}