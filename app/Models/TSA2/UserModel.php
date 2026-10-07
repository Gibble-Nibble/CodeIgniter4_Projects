<?php

namespace App\Models\TSA2;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'tasks';
    protected $table = 'tsa2_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'full_name', 'email', 'password', 'created_at'];
    protected $returnType = 'array';
}
