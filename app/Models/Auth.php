<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['username', 'email', 'password', 'address', 'no_tlp', 'img_profile', 'verification_token', 'status', 'created_at', 'updated_at', 'role', 'is_deleted', 'deleted_at', 'is_recovery'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getAllCustomers($role, $status)
    {
        return $this->where(['role' => $role, 'status' => $status, 'is_deleted' => 0])->findAll();
    }

    public function getDeletedCustomers($isDeleted)
    {
        return $this->where('is_deleted', $isDeleted)->findAll();
    }

    public function updateRecovery($id)
    {
        return $this->where("id", $id)->set(["is_recovery" => 1])->update();
    }
}