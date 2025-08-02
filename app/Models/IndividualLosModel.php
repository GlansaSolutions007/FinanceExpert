<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class IndividualLosModel extends Model
{
    protected $table = 'individual_los_sheet';

    protected $allowedFields = [
        'srno', 
        'aname',
        'bankname',
        'branch',
        'agreementno',
        'customername',
        'tenure',
        'disbursaldate',
        'executive',
        'state',
        'bank',
        'created_date',
        'created_by',
        'modify_date',
        'modify_by'
    ];


    public function getDataBetweenDates($fromDate, $toDate, $bankName)
    {
        $query = $this->where('bankname', $bankName)
            ->where("STR_TO_DATE(disbursaldate, '%d-%b-%y') BETWEEN '$fromDate' AND '$toDate'", null, false)
            ->findAll();
    
        return $query;
    }

}