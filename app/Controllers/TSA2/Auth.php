<?php

namespace App\Controllers\TSA2;

use App\Controllers\BaseController;
use App\Models\TSA2\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session('tsa2_user_id')) {
            return redirect()->to('/TSA2/profile');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = ['username' => 'required', 'password' => 'required'];
            if (! $this->validate($rules)) {
                log_message('error', 'TSA2 login validation failed: {errors}', ['errors' => json_encode($this->validator->getErrors())]);
                return view('TSA2/login', ['validation' => $this->validator]);
            }

            $model = new UserModel();
            $password = (string) $this->request->getPost('password');
            $user = $model->where('username', trim((string) $this->request->getPost('username')))->first();
            $validPassword = $user && (
                password_verify($password, $user['password'])
                || hash_equals((string) $user['password'], $password)
            );

            if ($validPassword) {
                if (! password_get_info((string) $user['password'])['algo']) {
                    if (! $model->update($user['id'], ['password' => password_hash($password, PASSWORD_DEFAULT)])) {
                        log_message('error', 'TSA2 password upgrade failed for user ID {id}: {errors}', [
                            'id' => $user['id'],
                            'errors' => json_encode($model->errors()),
                        ]);
                    }
                }
                session()->regenerate();
                session()->set(['tsa2_user_id' => $user['id'], 'tsa2_username' => $user['username']]);
                return redirect()->to('/TSA2/profile')->with('success', 'Login successful.');
            }

            log_message('error', 'TSA2 login failed for username: {username}', [
                'username' => $this->request->getPost('username'),
            ]);
            return view('TSA2/login', ['error' => 'Invalid username or password.']);
        }

        return view('TSA2/login');
    }

    public function register()
    {
        if (session('tsa2_user_id')) {
            return redirect()->to('/TSA2/profile');
        }

        if ($this->request->getMethod() !== 'post') {
            return view('TSA2/register');
        }

        $rules = [
            'username'         => 'required|min_length[3]|max_length[100]',
            'full_name'        => 'required|max_length[255]',
            'email'            => 'required|valid_email|max_length[255]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            log_message('error', 'TSA2 registration validation failed: {errors}', ['errors' => json_encode($this->validator->getErrors())]);
            return view('TSA2/register', ['validation' => $this->validator]);
        }

        $username = trim((string) $this->request->getPost('username'));
        $model = new UserModel();
        if ($model->where('username', $username)->first()) {
            log_message('error', 'TSA2 registration rejected duplicate username: {username}', ['username' => $username]);
            return view('TSA2/register', [
                'error' => 'That username is already registered.',
            ]);
        }

        $userId = $model->insert([
            'username'   => $username,
            'full_name'  => trim((string) $this->request->getPost('full_name')),
            'email'      => trim((string) $this->request->getPost('email')),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($userId === false) {
            log_message('error', 'TSA2 registration failed: {errors}', ['errors' => json_encode($model->errors())]);
            return view('TSA2/register', [
                'error' => 'Your account could not be created. Please check the details and try again.',
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
