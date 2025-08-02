<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class CommonModel extends Model
{
    protected $table = 'los_master';
    protected $allowedFields = [
        'id', 
        'srno', 
        'bankname',
        'branch',
        'agreementno',
        'customername',
        'tenure',
        'disbursaldate',
        'executive',
        'state'
    ];
    
    // public function compareDates($formattedtoDate, $formattedfromDate)
    // {
    //     // Perform the database query to fetch data based on date comparison
    //     $query = $this->table($this->los_master)
    //         ->where('disbursaldate >=', $formattedtoDate)
    //         ->where('disbursaldate <=', $formattedfromDate)
    //         ->get();

    //     // Return the query result
    //     return $query->getresult();
    // }
  


//   public function getDataBetweenDates($fromDate, $toDate, $bankName)
//     {
//                       ->where('bankname',$bankName);
//         $query = $this->where("STR_TO_DATE(disbursaldate, '%d-%b-%y') BETWEEN '$fromDate' AND '$toDate'", null, false)
//             ->findAll();
            

//         return $query;
//     }
public function getDataBetweenDates($fromDate, $toDate, $bankName)
{
    $query = $this->where('bankname', $bankName)
        ->where("STR_TO_DATE(disbursaldate, '%d-%b-%y') BETWEEN '$fromDate' AND '$toDate'", null, false)
        ->findAll();

    return $query;
}

// Updating the agent name start



// Updating the agent name start

}