<?php

namespace App\Models;

use CodeIgniter\Model;

class Paymentmodel extends Model
{
    
    protected $table            = 'payment';
    protected $primaryKey       = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id','agent_id','agent_name','gst_no','transaction_id','payment_for','transaction_type','transaction_date','payment_amount','payableAmount','remark','voucher','created_date','created_by','modify_on','modify_by','status'];

    // Dates
    // public function getCountOfAgents()
    // {
    //   return $this->countAllResults();
    // }
    
     public function getDataBetweenDate($fromDate, $toDate, $agentName)
{
    // Convert the input dates to the correct format
    $fromDate = date('Y-m-d', strtotime($fromDate));
    $toDate = date('Y-m-d', strtotime($toDate));

    // Build the query
    $query = $this->db->table('payment')
        ->select('id, transaction_id, transaction_date, payment_amount, voucher, gst_no')
        ->where('agent_id', $agentName)
        ->where('transaction_date >=', $fromDate)
        ->where('transaction_date <=', $toDate)
        ->get();

    // Execute the query and fetch the results
    $result = $query->getResultArray();

    return $result;
}

    public function getRowDataById($rowId)
    {
        return $this->where('id', $rowId)->first(); // Assuming you want to fetch a single row
    }
    
    public function getAgentExportData($agentId, $fromDate, $toDate)
{
    try {
        $fromdate = date('Y-m-d', strtotime($fromDate));
        $todate = date('Y-m-d', strtotime($toDate));

        $result = $this->where('agent_id', $agentId)
            ->where('transaction_date >=', $fromdate)
            ->where('transaction_date <=', $todate)
            ->findAll();

        return $result;
    } catch (\Exception $e) {
        // Handle the exception as needed, such as logging the error
        // You can also re-throw the exception if necessary
        throw $e;
    }
}


  public function getDataByAgentIdWithSums($agentId, $fromDate, $toDate)
{
    $fromDate = date('Y-m-d', strtotime($fromDate));
    $toDate = date('Y-m-d', strtotime($toDate));

$query = $this->db->query(
    "SELECT * FROM `payment` 
WHERE agent_id= ? 
AND transaction_date BETWEEN ? AND ? 
AND (payment_for = ? OR payment_for=?)",
    


        [$agentId,$fromDate, $toDate,'mis', 'onspot']
);

return $query->getResult();

}
}