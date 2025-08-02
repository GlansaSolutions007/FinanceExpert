<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerateInvoiceModel extends Model
{
    
    protected $table            = 'generate_invoice';
    protected $primaryKey       = 'id';
   
    protected $allowedFields    = ['id', 'invoice_no', 'gst_no','address', 'agent_id', 'agentName','image', 'email', 'date', 'grossPayout', 'tds', 'netPayment','payableAmount', 'emi', 'payment_mode', 'commision', 'cgst', 'sgst', 'igst', 'alreadyPaid', 'fromdate', 'todate', 'fileName', 'totalAmount', 'created_date'];
    
    public function insertData($data)
    {
        return $this->insert($data);
    }
    
    
    public function insertAgentData($data)
    {
        $this->insert($data);
        return $this->find($this->insertID());
    }
    
   
    
    public function insertSubagentData($data)
    {
        $this->insert($data);
        return $this->find($this->insertID());
    }
       public function restrictDuplicateInsert($agentId, $fromdate, $todate)
    {
        return $this->where('agent_id', $agentId)
                    ->where('fromdate >=', $fromdate)
                    ->where('todate <=', $todate)
                    ->get()
                    ->getRow();
    }
    
    
    public function getAgentDataById($agentId) {
        // Retrieve agent data from the database based on the provided agent ID
        $query = $this->db->get_where('generate_invoice', ['id' => $agentId]);
        return $query->row_array();
    }
    
    public function getSubagentDataById($subagentId) {
        // Retrieve subagent data from the database based on the provided subagent ID
        $query = $this->db->get_where('generate_invoice', ['id' => $subagentId]);
        return $query->row_array();
    }

    public function getDataBetweenDateExport($fromDate, $toDate)
        {
            
             $fromDate = date('Y-m-d', strtotime($fromDate));
             $toDate = date('Y-m-d', strtotime($toDate));
            // Modify this query to fetch data based on your date range and database schema
                $query = $this->select('invoice_no, agent_id, agentName, cgst, sgst, igst, tds, gst_no')
                ->where('fromdate >=', $fromDate)
                ->where('todate <=', $toDate)
                ->findAll(); // Use findAll to get all matching rows

                 return $query;
        }
    
    public function getDataBetweenDate($fromDate, $toDate)
    {
        // Convert the provided dates to MySQL date format (Y-m-d)
        $fromDate = date('Y-m-d', strtotime($fromDate));
        $toDate = date('Y-m-d', strtotime($toDate));
        
        // Retrieve individual rows within the date range
        $rows = $this->select('invoice_no, agent_id, agentName, cgst, sgst, igst, tds, gst_no')
                     ->where('fromdate >=', $fromDate)
                     ->where('todate <=', $toDate)
                     ->findAll(); // Use findAll() to retrieve all rows
        
        // Calculate the total TDS amount
        $totalTDS = array_sum(array_column($rows, 'tds'));
        
        return [
            'rows' => $rows,
            'totalTDS' => $totalTDS,
        ];
    }

    public function checkDataExists($agentId, $fromDate, $toDate)
    {
        $existingRow = $this->where('agent_id', $agentId)
                            ->where('fromdate >=', $fromDate)
                            ->where('todate <=', $toDate)
                            ->findAll();
    
        return $existingRow; // Return the existing row or null if not found
    }

    
}