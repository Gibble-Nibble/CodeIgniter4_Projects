<?php

namespace App\Models\M2;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'full_name',
        'email',
        'phone',
        'created_at'
    ];
}