<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function home()
    {
        return view('/M1/home');
    }

    public function about()
    {
        return view('/M1/about');
    }
}