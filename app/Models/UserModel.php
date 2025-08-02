<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    
    protected $table            = 'bank_master';
    protected $primaryKey       = 'id';
   
    protected $allowedFields    = ['id','name','branch','address','from_date','to_date','created_on','created_by','modify_on','modify_by','status'];
    
     public function getCountOfBanks()
    {
        
        return $this->where('status', 1)->countAllResults();
    }



    // Dates
   
//     public function insert($data)
// {
//     return $this->insert($data);
// }

}