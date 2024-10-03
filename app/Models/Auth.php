<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'email', 'password', 'address', 'telephone', 'img_profile', 'status', 'created_at', 'updated_at', 'role'];

    public function getUsers()
    {
        return $this->findAll();
    }
}