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

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/TSA2/login');
    }
}
