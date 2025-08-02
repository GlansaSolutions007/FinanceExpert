<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class CommonModel extends Model
{
    protected $table = 'los_master';
    protected $allowedFields = [
        'id', 
        'SrNo', 
        'AgreementNo',
        'DisbursalDate',
        'CustomerName',
        'Bank',
        'Location',
        'State',
        'Gross',
        'TopUp',
        'Net',
        'LoanAmount',
        'Scheme',
        'Category',
        'PayOutPercentage',
        'WfhDeduction',
        'NetPercentage',
        'GrossPayout',
        'TDS',
        'NetPayment',
        'Executive',
        'created_on',
        'created_by',
        'modify_on',
        'modify_by'
    ];
          public function insert($data = null, bool $returnID = true)
            {
                if (!empty($data['DisbursalDate'])) {
                    $data['DisbursalDate'] = date('Y-m-d', strtotime($data['DisbursalDate']));
                }
        
                return parent::insert($data, $returnID);
            }
            
     public function getAgentExportData($agentId, $bankName, $fromDate, $toDate)
    {
        $fromdate = date('Y-m-d', strtotime($fromDate));
         $todate = date('Y-m-d', strtotime($toDate));
         
        return $this->where('Executive', $agentId)
                     ->where('Bank', $bankName)
                    ->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->findAll();
    }
    
     public function getAgentExportDatas($agentId, $fromDate, $toDate)
    {
        $fromdate = date('Y-m-d', strtotime($fromDate));
         $todate = date('Y-m-d', strtotime($toDate));
         
        return $this->where('Executive', $agentId)
                    ->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->findAll();
    }
    
      public function getAgentExportDatass($agentId, $fromDate, $toDate, $losNo, $bankName)
    {
        $fromdate = date('Y-m-d', strtotime($fromDate));
         $todate = date('Y-m-d', strtotime($toDate));
         
        if($fromDate && $toDate && $losNo && $agentId && $bankName) {
           return $this->where('Executive', $agentId)
                    ->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->where('Bank', $bankName)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        } 
        else if($fromDate && $toDate && $losNo && $agentId) {
           return $this->where('Executive', $agentId)
                    ->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->where('Bank', $bankName)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        }else if($bankName && $losNo && $agentId) {
            return $this->where('Executive', $agentId)
                    ->where('Bank', $bankName)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        }
        else if($agentId && $fromDate && $toDate && $bankName) {
               return $this->where('Executive', $agentId)
                    ->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->where('Bank', $bankName)
                    ->findAll();
        }
        else if($losNo && $fromDate && $toDate && $bankName) {
                return $this->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->where('Bank', $bankName)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        }
        else if($agentId && $losNo) {
            return $this->where('Executive', $agentId)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        } else if($bankName && $losNo) {
           return $this->where('Bank', $bankName)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        }else if($fromDate && $toDate && $losNo) {
           return $this->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->like('AgreementNo', $losNo)
                    ->findAll();
        }else if($agentId && $bankName) {
            return $this->where('Executive', $agentId)
                    ->where('Bank', $bankName)
                    ->findAll();
        }else if($agentId && $fromDate && $toDate) {
           return $this->where('Executive', $agentId)
                    ->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->findAll();
        }else if($bankName && $fromDate && $toDate) {
            return $this->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->where('Bank', $bankName)
                    ->findAll();
        } else if($losNo) {
            return $this->like('AgreementNo', $losNo)
                    ->findAll();
        } else if($bankName) {
           return $this->where('Bank', $bankName)
                    ->findAll();
        } else if($fromDate && $toDate) {
            return $this->where('DisbursalDate >=', $fromdate)
                    ->where('DisbursalDate <=', $todate)
                    ->findAll();
        } else if($agentId) {
            return $this->where('Executive', $agentId)
                    ->findAll();
        }
    }
    
    


public function getDataBetweenDates($fromDate, $toDate, $bankName)
    {
        $query = $this->where('Bank', $bankName)
            ->where("STR_TO_DATE(DisbursalDate, '%Y-%m-%d') BETWEEN '$fromDate' AND '$toDate'", null, false)
            ->findAll();

        // Convert disbursal date back to the desired format (dd-mm-yyyy)
        foreach ($query as &$row) {
            $row['DisbursalDate'] = date('d-m-Y', strtotime($row['DisbursalDate']));
        }

        return $query;
    }
    
    
  public function getDataBetweenDate($fromDate, $toDate, $agentName)
{
    $fromdate = date('Y-m-d', strtotime($fromDate));
    $todate = date('Y-m-d', strtotime($toDate));

    $query = $this->db->table('los_master as los')
        ->select('los.Executive, los.Bank, SUM(los.NetPayment) as NetPayment')
        ->join('agent_master as a', 'los.Executive = a.user_id', 'inner')
        ->where('los.Executive', $agentName)
        ->where('los.DisbursalDate >=', $fromdate)
        ->where('los.DisbursalDate <=', $todate)
        ->groupBy('los.Executive, los.Bank')
        ->get();

    return $query->getResultArray();
}


public function getDataByLosNoLike($losNo)
{
    $query = $this->db->table('los_master')
        ->like('AgreementNo', $losNo)
        ->get()
        ->getResultArray();
    
    return $query;
}

public function getDataByAgentAndLos($agentId,$losNo)
{
    $query = $this->db->table('los_master')
        ->where('Executive', $agentId)
        ->like('AgreementNo', $losNo)
        ->get()
        ->getResultArray();
    
    return $query;
}

public function getDataByBankAndLos($bankName,$losNo)
{
    $query = $this->db->table('los_master')
        ->where('Bank', $bankName)
        ->like('AgreementNo', $losNo)
        ->get()
        ->getResultArray();
    
    return $query;
}


public function getDataByAgentAndBank($agentId,$bankName)
{
    $query = $this->db->table('los_master')
        ->where('Bank', $bankName)
        ->where('Executive', $agentId)
        ->get()
        ->getResultArray();
    
    return $query;
}


public function getDataByAgentAndFromToDate($agentId,$fromDate, $toDate)
{
       $query = $this->db->table('los_master')
        ->where('Executive', $agentId)
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getDataByFromToLosAgent($fromDate,$toDate,$losNo, $agentId)
{
       $query = $this->db->table('los_master')
        ->where('Executive', $agentId)
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->like('AgreementNo', '%' . $losNo . '%')
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getDataByBankLosAgent($bankName,$losNo, $agentId)
{
       $query = $this->db->table('los_master')
        ->where('Executive', $agentId)
        ->where('Bank', $bankName)
        ->like('AgreementNo', '%' . $losNo . '%')
        ->get()
        ->getResultArray();
    
    return $query;

}


public function getDataByBankAgentFromToDate($bankName,$fromDate, $toDate, $agentId)
{
       $query = $this->db->table('los_master')
        ->where('Executive', $agentId)
        ->where('Bank', $bankName)
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getDataByBankLosFromToDate($bankName,$fromDate, $toDate, $losNo)
{
       $query = $this->db->table('los_master')
        ->like('AgreementNo', '%' . $losNo . '%')
        ->where('Bank', $bankName)
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getAllData($bankName,$fromDate, $toDate, $losNo, $agentId)
{
       $query = $this->db->table('los_master')
        ->like('AgreementNo', '%' . $losNo . '%')
        ->where('Bank', $bankName)
        ->where('Executive', $agentId)
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getDataByBankAndFromToDate($bankName,$fromDate, $toDate)
{
       $query = $this->db->table('los_master')
        ->where('Bank', $bankName)
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getDataByfromToDateAndLos($fromDate, $toDate, $losNo)
{
       $query = $this->db->table('los_master')
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->like('AgreementNo', $losNo)
        ->get()
        ->getResultArray();
    
    return $query;

}

public function getDataBetweenDatesLos($fromDate, $toDate)
{
    $query = $this->db->table('los_master')
        ->where('DisbursalDate >=', $fromDate)
        ->where('DisbursalDate <=', $toDate)
        ->get()
        ->getResultArray();
    
    return $query;
}



public function getDataByAgentFromToDate($agentId, $fromDate, $toDate)
{
    $query = $this->db->table('los_master')
            ->where('Executive', $agentId)
            ->where('DisbursalDate >=', $fromDate)
            ->where('DisbursalDate <=', $toDate)
            ->get()
            ->getResultArray();
    
    return $query;
}

public function getDistinctBankNames()
{
    // Assuming 'banks' is the name of the table containing bank names
    $query = $this->db->table('los_master')
                    ->select('Bank')
                    ->distinct()
                    ->get();

    return $query->getResultArray();
}

public function getDistinctAgentId()
{
    // Assuming 'banks' is the name of the table containing bank names
    $query = $this->db->table('los_master')
                    ->select('Executive')
                    ->distinct()
                    ->get();

    return $query->getResultArray();
}
        
        
public function getDataByAgentId($agentId)
{
    // Fetch data based on the provided agent ID
    $query = $this->db->table('los_master')
        ->where('Executive', $agentId)
        ->get()
        ->getResultArray();
    
    return $query;
}

public function getDataByBank($bankName)
{
    // Fetch data based on the provided bank name
    $query = $this->db->table('los_master')
        ->where('Bank', $bankName)
        ->get()
        ->getResultArray();
    
    return $query;
}


    
    public function getDataBetweenDateBank($bankName)
    {
        $query = $db->table('los_master AS los')
            ->select('a.name AS Bank, los.Executive')
            ->join('bank_master AS a', 'los.Bank = a.name')
            ->where('los.Bank', $bankName)
            ->groupBy('los.Bank, los.Executive');

        $results = $query->get();

        if ($results) {
            return $results->getResult();
        } else {
            return [];
        }
    }

   
   public function getComparisonData($bankname, $fromdate, $todate, $agentname)
{
    $fromdate = date('Y-m-d', strtotime($fromdate));
    $todate = date('Y-m-d', strtotime($todate));

    return $this->where('Bank', $bankname)
                ->where('DisbursalDate >=', $fromdate)
                ->where('DisbursalDate <=', $todate)
                ->where('Executive', $agentname)
                ->findAll();
}


public function updatePayoutPercentage($category, $percentage)
{
    // Update the los_master table with the fetched percentage value
    $this->db->where('category', $category)->update('los_master', ['PayOutPercentage' => $percentage]);
}


public function updateExecutive($rowId, $newExecutive)
    {
        $data = [
            'Executive' => $newExecutive
        ];

        $this->update($rowId, $data);
    }
    
        public function updateData($id, $wfh, $netPercentage, $grossPayout, $tds, $netPayment)
        {
            return $this->where('id', $id)
                        ->set('WfhDeduction', $wfh)
                        ->set('NetPercentage', $netPercentage)
                        ->set('GrossPayout', $grossPayout)
                        ->set('TDS', $tds)
                        ->set('NetPayment', $netPayment)
                        ->update();
        }

    

}