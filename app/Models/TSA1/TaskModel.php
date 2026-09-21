<?php

namespace App\Models\TSA1;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $DBGroup = 'tasks';

    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'status',
        'task_date',
        'created_at'
    ];
}