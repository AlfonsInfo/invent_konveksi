<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username',$username)->first();
        if($data)
        {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass)
            {
                $userCount = $model->countAllResults();
                $data['foto_user'] = 'data:image/jpeg;base64,' .base64_encode($data['foto_user']);
                $ses_data = [
                    'id_user' => $data['id_user'],
                    'nama_user' => $data['nama_user'],
                    'username' => $data['username'],
                    'status_user' => $data['status_user'],
                    'foto_user' => $data['foto_user'],
                    'id_role' => $data['id_role'],
                    'logged_in' => true,
                    'count' => $userCount                    
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
