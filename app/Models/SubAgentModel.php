<?php

namespace App\Models;

use CodeIgniter\Model;

class SubAgentModel extends Model
{
    protected $table = 'sub_agent';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['agent_id', 'name', 'phone_no', 'email', 'address','percentage','adhar_no','pan_no','gst_no','created_on','created_by','modify_on','modify_by','status'];

    public function insertBatch(?array $set = null, ?bool $escape = null, int $batchSize = 100, bool $testing = false)
    {
        return $this->db->table($this->table)->insertBatch($set, $escape, $batchSize, $testing);
    }
   public function getSubAgentById($subagent_id) {
       
        $this->db->where('id', $subagent_id);
        $query = $this->db->get('sub_agent'); 

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    public function getCountOfsubAgent()
    {
        return $this->countAll();
    }
    
   
}