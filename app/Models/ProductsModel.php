<?php

namespace App\Models;

use CodeIgniter\Model;


//* Go to model to see default value
class ProductsModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $useTimeStamps = true;

    //default : created_at , updated_at
    protected $allowedFields = ['nama_product', 'harga_product', 'deskripsi','foto_product'];
    // protected useTimeStamps = []
    
    //*SoftDeletes ?

}