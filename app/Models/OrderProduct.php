<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';
    protected $primaryKey = 'id_order_product';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price', 'total_price', 'created_at', 'updated_at'];

}