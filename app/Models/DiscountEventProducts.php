<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountEventProduct extends Model
{
    protected $table = 'discount_event_products';
    protected $primaryKey = 'id';

    protected $allowedFields = [
         'discount_id', 'product_id'
    ];
}