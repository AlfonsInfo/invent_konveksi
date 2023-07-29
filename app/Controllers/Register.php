<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RolesModel;

class Register extends BaseController
{
    public function index()
    {
        $rolesModel = new RolesModel();
        $roles = $rolesModel->findAll();

        $data = [
            'title' => 'Form | Tambah Tambah User',
            'pageTitle' => 'Tambah User',
            'roles' => $roles,
            'validation' => \config\Services::validation()
        ];

        return view('Users/UserCreate.php', $data );
}

    public function save()
    {
        //* Validasi

        $model = new UserModel();
        $gambar = $this->request->getFile('foto_user');

        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
            'id_role' => $this->request->getVar('id_role'),
            'foto_user' => file_get_contents($gambar->getTempName())
        ];
        $model->save($data);
        return redirect()->to('/users');

    }

}
