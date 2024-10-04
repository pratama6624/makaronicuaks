<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['username', 'email', 'password', 'address', 'no_tlp', 'img_profile', 'verification_token', 'status', 'created_at', 'updated_at', 'role'];

    public function getUsers()
    {
        return $this->findAll();
    }
}