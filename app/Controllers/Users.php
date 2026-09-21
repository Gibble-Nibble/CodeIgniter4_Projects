<?php

namespace App\Controllers;
use App\Models\M2\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $users = [
            [
                'username' => 'admin',
                'full_name' => 'Juan Dela Cruz',
                'role' => 'Administrator'
            ],
            [
                'username' => 'cashier1',
                'full_name' => 'Maria Santos',
                'role' => 'Cashier'
            ],
            [
                'username' => 'cashier2',
                'full_name' => 'Pedro Reyes',
                'role' => 'Cashier'
            ],
            [
                'username' => 'manager1',
                'full_name' => 'Ana Garcia',
                'role' => 'Manager'
            ],
            [
                'username' => 'staff1',
                'full_name' => 'Carlos Mendoza',
                'role' => 'Staff'
            ]
        ];

        return view('M1/users', ['users' => $users]);
    }

    public function module2_index()
    {
        $userModel = new UserModel();

        $users = $userModel->findAll();

        return view('M2/users', ['users' => $users]);
    }
}