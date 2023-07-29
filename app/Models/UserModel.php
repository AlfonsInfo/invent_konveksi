<?php

namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_users';
    protected $useTimeStamps = true;
    //default : created_at , updated_at
    protected $allowedFields = ['nama_user', 'username', 'password','status_user','id_role','foto_user'];


}