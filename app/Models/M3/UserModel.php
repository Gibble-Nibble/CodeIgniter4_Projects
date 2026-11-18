<?php

namespace App\Models\M3;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'm3';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'username',
        'full_name',
        'avatar',
        'created_at',
    ];
    protected $useTimestamps = true;

    protected $validationRules = [
        'username' => 'required|min_length[4]|max_length[30]|regex_match[/^[A-Za-z0-9._-]+$/]',
        'full_name' => 'required|min_length[2]|max_length[100]',
    ];
}
