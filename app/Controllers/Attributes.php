<?php

namespace App\Controllers;

use App\Models\AttributesModel;

class Attributes extends BaseController
{

    protected $AttributesModel; 
    public function __construct()
    {
        //* ini juga bisa dilakukan di Base Controller in case semua controller butuh data ini
        $this->AttributesModel = new AttributesModel();
    }

    public function index()
    {
        $attributes = $this->AttributesModel->findAll();
        $data = [
            'title' => 'Attributes',
            'attributes' => $attributes
        ];

        //*Debugging
        // dd($data); 
        //*Akhir Dari Debugging

         return view('Attributes/AttributesPage.php', $data );
    }


    public function create()
    {
        $data = [
            'title' => 'Form | Tambah Attribut'
        ];

        return view ('attribute/create', $data);
    }

}
