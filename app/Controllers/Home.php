<?php

namespace App\Controllers;

class Home extends BaseController
{
    //* this merujuk pada controller parent (BaseController)
    public function index()
    {
        return view('welcome_message');
    }

    public function coba($params = "Default" ,$umur = 0)
    {
        return "Hallo, nama saya " . $params . " umur saya";
    }
}
