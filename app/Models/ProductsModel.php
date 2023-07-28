<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $useTimeStamps = true;
    //default : created_at , updated_at
    protected $allowedFields = ['nama_product', 'harga_product', 'deskripsi','foto_product'];

    public function productCategory()
    {
        return $this->hasOne('App\Models\ProductCategoryModel', 'id_category');
    }

}