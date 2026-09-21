<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $customers = $customerModel->findAll();

        return view('M1/customers', ['customers' => $customers]);
        return view('M2/customers', ['customers' => $customers]);
    }
}