<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Reports extends BaseController
{
    public function index()
    {

        $db = db_connect();

        $query = $db->query("
                SELECT
                YEAR(date) AS year,
                MONTH(date) AS month,
                SUM(CASE WHEN log_action = 'in' THEN quantity ELSE 0 END) AS products_in,
                SUM(CASE WHEN log_action = 'out' THEN quantity ELSE 0 END) AS products_out
                FROM
                logs
                GROUP BY
                YEAR(date),
                MONTH(date)
                ORDER BY
                year, month;
                ");

        $products = $query->getResult();

        $data = [
            'title' => 'Reports',
            'pageTitle' => 'Reports',
            'logs' => $products,
            'validation' => \config\Services::validation()
        ];

        return view('Reports/ReportsPage.php', $data );
    }

}
