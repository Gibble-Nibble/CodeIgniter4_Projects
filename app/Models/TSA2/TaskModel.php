<?php

namespace App\Models\TSA2;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $DBGroup = 'tasks';
    protected $table = 'tsa2_tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'status', 'task_date', 'created_at', 'is_archived'];
    protected $returnType = 'array';

    public function active()
    {
        return $this->where('is_archived', 0);
    }
}
