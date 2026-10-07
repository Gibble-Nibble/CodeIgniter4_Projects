<?php

namespace App\Controllers\TSA2;

use App\Controllers\BaseController;
use App\Models\TSA2\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session('tsa2_user_id')) {
            return redirect()->to('/TSA2/tasks');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = ['username' => 'required', 'password' => 'required'];
            if (! $this->validate($rules)) {
                return view('TSA2/login', ['validation' => $this->validator]);
            }

            $user = (new UserModel())->where('username', $this->request->getPost('username'))->first();
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                session()->regenerate();
                session()->set(['tsa2_user_id' => $user['id'], 'tsa2_username' => $user['username']]);
                return redirect()->to('/TSA2/tasks');
            }

            return view('TSA2/login', ['error' => 'Invalid username or password.']);
        }

        return view('TSA2/login');
    }

    public function register()
    {
        if (session('tsa2_user_id')) {
            return redirect()->to('/TSA2/tasks');
        }

        if ($this->request->getMethod() !== 'post') {
            return view('TSA2/register');
        }

        log_message('error', 'TSA2 REGISTER POST RECEIVED');

        $rules = [
            'username'         => 'required|min_length[3]|max_length[100]',
            'full_name'        => 'required|max_length[255]',
            'email'            => 'required|valid_email|max_length[255]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return view('TSA2/register', ['validation' => $this->validator]);
        }

        $model = new UserModel();
        if ($model->where('username', $this->request->getPost('username'))->first()) {
            return view('TSA2/register', [
                'error' => 'That username is already registered.',
            ]);
        }

        $userId = $model->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($userId === false) {
            return view('TSA2/register', [
                'error' => 'Your account could not be created. Please try again.',
            ]);
        }

        return redirect()->to('/TSA2/login')->with('success', 'Registration successful. Please log in.');
    }

    public function logout()
    {
        session()->remove(['tsa2_user_id', 'tsa2_username']);
        return redirect()->to('/TSA2/login');
    }
}
