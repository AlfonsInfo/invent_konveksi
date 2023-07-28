<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RupiahFormatter extends Controller
{
    public function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
