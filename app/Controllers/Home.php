<?php

namespace App\Controllers;

class Home extends BaseController
{
    //* this merujuk pada controller parent (BaseController)
    public function index()
    {
        return view('welcome_message');
    }
}
