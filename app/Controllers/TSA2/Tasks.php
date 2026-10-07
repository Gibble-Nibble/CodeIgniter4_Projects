<?php

namespace App\Controllers\TSA2;

use App\Controllers\BaseController;
use App\Models\TSA2\TaskModel;
use App\Models\TSA2\UserModel;

class Tasks extends BaseController
{
    private function requireLogin()
    {
        if (! session('tsa2_user_id')) {
            return redirect()->to('/TSA2/login');
        }
        return null;
    }

    public function welcome()
    {
        $tasks = (new TaskModel())->active()->where('task_date', date('Y-m-d'))->orderBy('id', 'ASC')->findAll();
        return view('TSA2/index', ['tasks' => $tasks]);
    }

    public function index()
    {
        $tasks = (new TaskModel())->active()->orderBy('task_date', 'ASC')->findAll();
        return view('TSA2/tasks', ['tasks' => $tasks]);
    }

    public function profile()
    {
        return view('TSA2/profile', ['user' => (new UserModel())->first()]);
    }

    public function about()
    {
        return view('TSA2/about');
    }

    public function new()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }
        return view('TSA2/form', ['title' => 'New Task', 'action' => '/TSA2/tasks']);
    }

    public function create()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }
        if (! $this->validate(['title' => 'required', 'task_date' => 'required|valid_date[Y-m-d]'])) {
            return view('TSA2/form', ['title' => 'New Task', 'action' => '/TSA2/tasks', 'validation' => $this->validator, 'task' => $this->request->getPost()]);
        }
        (new TaskModel())->insert([
            'title' => $this->request->getPost('title'),
            'status' => $this->request->getPost('status') ?: 'Pending',
            'task_date' => $this->request->getPost('task_date'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->to('/TSA2/tasks');
    }

    public function edit(int $id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }
        $task = (new TaskModel())->active()->find($id);
        if (! $task) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('TSA2/form', ['title' => 'Edit Task', 'action' => '/TSA2/tasks/' . $id, 'task' => $task]);
    }

    public function update(int $id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }
        if (! $this->validate(['title' => 'required', 'task_date' => 'required|valid_date[Y-m-d]'])) {
            return view('TSA2/form', ['title' => 'Edit Task', 'action' => '/TSA2/tasks/' . $id, 'validation' => $this->validator, 'task' => $this->request->getPost()]);
        }
        $model = new TaskModel();
        if (! $model->active()->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'status' => $this->request->getPost('status') ?: 'Pending',
            'task_date' => $this->request->getPost('task_date'),
        ]);
        return redirect()->to('/TSA2/tasks');
    }

    public function delete(int $id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }
        $model = new TaskModel();
        if (! $model->active()->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $model->update($id, ['is_archived' => 1]);
        return redirect()->to('/TSA2/tasks');
    }
}
