<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id_payment';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['order_id', 'payment_method', 'payment_status', 'payment_reference', 'amount', 'paid_at', 'created_at', 'updated_at'];

}