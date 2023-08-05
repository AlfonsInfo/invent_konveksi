<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $useTimeStamps = true;
    //default : created_at , updated_at
    protected $allowedFields = ['nama_product', 'harga_product','foto_product','id_details_warna','id_details_ukuran','id_brand', 'id_category', 'stok_total'];

    public function productCategory()
    {
        return $this->hasOne('App\Models\ProductCategoryModel', 'id_category');
    }


    protected $afterInsert    = ['insertLogAfterInsert'];
    // protected $afterDelete    = ['deleteLogAfterDelete'];
    // protected $afterDelete    = [];
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';


    public function insertLogAfterInsert(array $data)
    {

        $currentUser =  \Config\Services::session()->get('id_user');
        $product = $this->find($data['id']);
        $date = date('Y-m-d H:i:s');
        $LogsModel = new \App\Models\LogsModel();

        $logData =[
            'id_product' => $product['id_product'],
            'quantity' => $product['stok_total'],
            'log_action' => 'new',
            'date' => $date,
            'id_user' => $currentUser
        ];
        $LogsModel->save($logData);
    }


    // public function deleteLogAfterDelete(array $data)
    // {
    //     dd($data);
    //     $currentUser =  \Config\Services::session()->get('id_user');
    //     $date = date('Y-m-d H:i:s');
    //     $LogsModel = new \App\Models\LogsModel();
    //     $logData = [
    //         'id_product' => $data['id_product'], // ID produk yang dihapus
    //         'log_action' => 'delete', // atau sesuai yang Anda butuhkan untuk menandakan log hapus produk
    //         'date' => $date,
    //         'id_user' => $currentUser

    //     ];
    //     $LogsModel->insert($logData);
    // }
}