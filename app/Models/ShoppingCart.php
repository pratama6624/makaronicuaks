<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';
    protected $primaryKey = 'id_cart';

    protected $allowedFields = ['user_id', 'product_id', 'quantity'];

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
        'shopping_cart.user_id',
        'shopping_cart.product_id',
        'shopping_cart.quantity',
    ];

    public function getCartByProductId($productId)
    {
        return $this->where('product_id', $productId)->first();
    }

    public function getAllCartByProductId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getAllProductsIncludingDiscountByCart($userId)
    {
        return $this->select($this->selectFields)
            ->join("products", "products.id_product = shopping_cart.product_id")
            ->join("discount_event_products", "discount_event_products.product_id = products.id_product", "left")
            ->join("discount_events", "discount_events.id_discount = discount_event_products.discount_id", "left")
            ->where("shopping_cart.user_id", $userId)
            ->findAll();
    }

    public function countAllProductsByUserId($userId)
    {
        return $this->selectSum("shopping_cart.quantity", "total_quantity")
        ->where("shopping_cart.user_id", $userId)
        ->get()
        ->getRowArray();
    }
}