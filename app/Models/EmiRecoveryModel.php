<?php

namespace App\Models;

use CodeIgniter\Model;

class EmiRecoveryModel extends Model
{
    
    protected $table            = 'emi_recovery';
    // protected $table            = 'issue_capital';
    protected $primaryKey       = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id','agent_id','agentName','loanAmount','month','monthlyEmi','remainingDebtAmount','date','remarks','voucher','created_date','created_by','modify_date','modify_by','status'];

    
    
   public function getAgentLoanData($agentId, $fromDate, $toDate)
    {
        $query =
        $this->db->table('emi_recovery')
        //  $this->db->table('issue_capital')
        ->where('agent_id', $agentId)
        ->where('date >=', $fromDate)
        ->where('date <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;
    }
     

}