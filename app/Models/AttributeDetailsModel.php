<?php

namespace App\Models;

use CodeIgniter\Model;


//* Go to model to see default value
class AttributeDetailsModel extends Model
{
    protected $table = 'attribute_details';
    protected $primaryKey = 'id_details';
    protected $useTimeStamps = true;

    //default : created_at , updated_at
    protected $allowedFields = ['nilai','id_attribute'];
    // protected useTimeStamps = []
    
    //*SoftDeletes ?
}