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
}