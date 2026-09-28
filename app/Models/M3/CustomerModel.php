<?php

namespace App\Models\M3;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $DBGroup = 'm3';
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'full_name',
        'email',
        'phone',
        'created_at',
    ];
    protected $useTimestamps = true;

    protected $validationRules = [
        'full_name' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|max_length[150]',
    ];
}
