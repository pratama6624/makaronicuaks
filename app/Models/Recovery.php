<?php

namespace App\Models;

use CodeIgniter\Model;

class Recovery extends Model
{
    protected $table = 'recovery_requests';
    protected $primaryKey = 'id_recovery';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['user_id', 'reason', 'status', 'created_at', 'updated_at'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getUserByEmail($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}