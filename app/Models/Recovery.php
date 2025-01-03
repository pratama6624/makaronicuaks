<?php

namespace App\Models;

use CodeIgniter\Model;

class Recovery extends Model
{
    protected $table = 'recovery_requests';
    protected $primaryKey = 'id_recovery';
    protected $createdField  = false;
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['user_id', 'reason', 'status', 'updated_at'];

    public function getUsers()
    {
        return $this->join("users", "users.id = recovery_requests.user_id")->findAll();
    }

    public function getUserByEmail($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    public function updateRecoveryRequest($id)
    {
        return $this->where("user_id", $id)->set(["updated_at" => date('Y-m-d H:i:s')])->update();
    }
}