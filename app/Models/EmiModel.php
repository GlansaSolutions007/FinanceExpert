<?php

namespace App\Models;

use CodeIgniter\Model;

class EmiModel extends Model
{
    
    protected $table            = 'emi';
    // protected $table            = 'issue_capital';
    protected $primaryKey       = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id','agent_id','agentName','loanAmount','month','monthlyEmi','remainingDebtAmount','date','remarks','voucher','created_date','created_by','modify_date','modify_by','status'];

    
    
    public function getAgentLoanData($agentId, $fromDate, $toDate)
    {
        $query =
        $this->db->table('emi')
        //  $this->db->table('issue_capital')
        ->where('agent_id', $agentId)
        ->where('date >=', $fromDate)
        ->where('date <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;
    }
    

    public function getAgentExportData($agentId, $fromDate, $toDate)
    {
        $fromdate = date('Y-m-d', strtotime($fromDate));
        $todate = date('Y-m-d', strtotime($toDate));

        return $this->where('agent_id', $agentId)
                    ->where('date >=', $fromdate)
                    ->where('date <=', $todate)
                    ->findAll();
    }

}