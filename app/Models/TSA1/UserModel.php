<?php

namespace App\Models\TSA1;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'tasks';

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'full_name',
        'email',
        'created_at'
    ];
}