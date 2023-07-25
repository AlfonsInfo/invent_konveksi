<?php

namespace App\Models;

use CodeIgniter\Model;


//* Go to model to see default value
class AttributesModel extends Model
{
    protected $table = 'attributes';
    protected $primaryKey = 'id_attribute';
    protected $useTimeStamps = true;

    //default : created_at , updated_at
    // protected $allowedFiels = [];
    // protected useTimeStamps = []
    
    //*SoftDeletes ?

}