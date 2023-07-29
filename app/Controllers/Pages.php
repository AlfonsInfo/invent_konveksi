<?php

namespace App\Controllers;

use App\Models\UserModel;

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
        // $userModel = new UserModel();
        // $users = $userModel->findAll();
        $db = db_connect();

        $query = $db->query("SELECT *FROM users u LEFT JOIN roles r ON u.id_role = r.id_role");

        $users= $query->getResultArray();

        foreach ($users as &$p) // Gunakan & sebelum $p agar dapat mengubah nilai asli dalam array
        {
            $p['foto_user'] = 'data:image/jpeg;base64,' . base64_encode($p['foto_user']);
        }
        $data = [
            'title' => 'Users',
            'pageTitle' => 'Users',
            'users' => $users,
            'validation' => \config\Services::validation()
        ];

        return view('Users/userPage', $data);
    }
}
