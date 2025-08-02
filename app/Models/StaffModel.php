<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    
    protected $table            = 'staff_master';
    protected $primaryKey       = 'id';
    // protected $returnType = 'array';
    protected $allowedFields    = ['id','name','email','password','role','status','created_on','created_by','modify_on','modify_by'];

    // Dates

    public function VerifyName($name, $password){
        $builder = $this->db->table('staff_master');
        $builder->select('id','name', 'password','role');
        $builder->where('name', $name);
         $builder->where('password', $password);
        $result = $builder->get();

        if(count($result->getResultArray()) == 1)
        {
            return $result->getRowArray();
        }
        else {
            return false;
        }

    }
    
    public function getCountOfStaff()
{
    return $this->where('status', 1)->countAllResults();
}
public function isStaffExist($name, $password, $is_admin)
{
    $query = $this->where('name', $name)
                  ->where('password', $password)
                  ->where('role', $is_admin)
                  ->countAllResults();
    return $query > 0;
}

   

    }
