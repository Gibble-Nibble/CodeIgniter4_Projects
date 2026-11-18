<?php

namespace App\Controllers\TFA4;

use App\Controllers\BaseController;
use App\Models\M3\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->has('tfa4_user_id')) {
            return redirect()->to('/TFA4/index');
        }

        if ($this->request->is('post')) {
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            if (! $this->validate($rules)) {
                return view('TFA4/login', [
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $username = trim((string) $this->request->getPost('username'));
            $password = (string) $this->request->getPost('password');
            $user = (new UserModel())->where('username', $username)->first();

            if ($user === null || ! password_verify($password, (string) $user['password'])) {
                return view('TFA4/login', [
                    'error' => 'Invalid username or password.',
                ]);
            }

            session()->regenerate(true);
            session()->set([
                'tfa4_user_id' => $user['id'],
                'tfa4_username' => $user['username'],
            ]);

            return redirect()->to('/TFA4/index');
        }

        return view('TFA4/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/TFA4/login');
    }
}
