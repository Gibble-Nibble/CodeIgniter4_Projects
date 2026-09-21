<?php

namespace App\Controllers\TSA1;

use App\Controllers\BaseController;
use App\Models\TSA1\TaskModel;
use App\Models\TSA1\UserModel;

class Tasks extends BaseController
{
    public function welcome()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('task_date', date('Y-m-d'))
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('TSA1/index', [
            'tasks' => $tasks
        ]);
    }

    public function index()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('TSA1/tasks', [
            'tasks' => $tasks
        ]);
    }

    public function profile()
    {
        $userModel = new UserModel();

        $user = $userModel->first();

        return view('TSA1/profile', [
            'user' => $user
        ]);
    }

    public function about()
    {
        return view('TSA1/about');
    }
}