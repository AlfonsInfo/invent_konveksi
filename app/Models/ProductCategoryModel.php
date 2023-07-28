<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductCategoryModel extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'id_category';
    protected $useTimeStamps = true;
    protected $allowedFields = ['nama_category'];
}