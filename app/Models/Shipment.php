<?php

namespace App\Models;

use CodeIgniter\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    protected $primaryKey = 'id_shipment';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['order_id', 'shipment_method', 'tracking_number', 'shipping_address', 'shipping_cost', 'status', 'shipped_at', 'delivered_at', 'created_at', 'updated_at'];

}