<?php

namespace App\Models;

use CodeIgniter\Model;


//* Go to model to see default value
class BrandsModel extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id_brand';
    protected $useTimeStamps = true;

    //default : created_at , updated_at
    protected $allowedFields = ['nama_brand'];
    // protected useTimeStamps = []
    
    //*SoftDeletes ?

}