<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logs extends BaseController
{
    public function index()
    {
        //* Koneksi Ke Database
        $db = db_connect();

        $query = $db
        ->query("SELECT *
                FROM logs l
                LEFT JOIN users u  ON l.id_user = u.id_user
                LEFT JOIN roles  r on u.id_role = r.id_role
                LEFT JOIN products p on l.id_product = p.id_product
        ");

        $hasil = $query->getResult();
        
            foreach($hasil as $p)
            {
                $p->foto_user = 'data:image/jpeg;base64,' . base64_encode($p->foto_user);
            }

        $data = [
            'title' => 'Monitoring Logs',
            'pageTitle' => 'Logs',
            'logs' => $hasil,
            'validation' => \config\Services::validation()
        ];

        return view('Logs/LogsPage.php', $data );
    }
}
