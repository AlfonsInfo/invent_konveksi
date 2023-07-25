<?php

namespace App\Controllers;

class Pages extends BaseController
{

    public function index()
    {
        $data = [
            "title" => "Employee | Log in"
        ];

        return view('Auth\Login', $data);
    }

    public function login()
    {
        $data = [
            "title" => "Employee | Log in"
        ];

        return view('Auth\Login', $data);
    }


    public function dashboard()
    {
        $data = [
            "title" => "Employee | Dashboard"
        ];

        return view('dashboard', $data);
    }

    public function profile()
    {
        $data = [
            "title" => "Employee | Profile"
        ];

        return view('profile', $data);
    }

    public function user()
    {
        $data = [
            "title" => "Employee | User"
        ];

        return view('Users/userPage', $data);
    }
}
