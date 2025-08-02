<?php

namespace App\Models;

use CodeIgniter\Model;

class NumberofScheme extends Model
{
    
    protected $table            = 'scheme_master';
    protected $primaryKey       = 'id';
   
    protected $allowedFields    = ['id','bank_id','scheme_name','created_on','created_by','status'];

}