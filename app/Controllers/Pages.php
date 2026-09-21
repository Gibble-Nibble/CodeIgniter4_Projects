<?php

namespace App\Controllers;

class Pages extends BaseController
{
    // Home page method
    public function home()
    {
        return view('home');
    }

    // Module 1 methods
    public function module1_index()
    {
        return view('M1/index');
    }

    public function module1_about()
    {
        return view('M1/about');
    }

    // Module 2 methods
    public function module2_index()
    {
        return view('M2/index');
    }

    public function module2_about()
    {
        return view('M2/about');
    }
}