<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountEvent extends Model
{
    protected $table = 'discount_events';
    protected $primaryKey = 'id_discount';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'name', 'start_date', 'end_date', 'description', 'created_at', 'updated_at', 'precentage'
    ];

    public function getAllDiscountEvent()
    {
        return $this->findAll();
    }

    public function getDiscountEventByID($id_discount_event)
    {
        return $this->where("id_discount", $id_discount_event)->first();
    }

    public function getProductDiscountEvent($id_discount_event)
    {
        return $this->select([
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
                'products.weight'
            ])
            ->join("discount_event_products", "discount_event_products.discount_id = discount_events.id_discount")
            ->where("id_discount", $id_discount_event)
            ->join("products", "products.id_product = discount_event_products.product_id")
            ->findAll();
    }
}