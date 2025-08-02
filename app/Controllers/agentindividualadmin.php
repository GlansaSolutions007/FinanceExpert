<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\IndividualLosModel;
use App\Models\AgentModel;


class agentindividualadmin extends BaseController
{



    public  function __construct()
    {
        helper(['url','form']);
        $this->agent = new AgentModel();
        $this->individualagent =  new IndividualLosModel();
    }

    public function displayagent()  
    {
        $data['users'] = $this->agent->findAll();
        
        return view('pages/agentsIndividualLos', $data);
    }
    
    // Existing code in the controller...

        public function getagent($selectedAgentId)
        {
            $data = $this->agent->where('user_id', $selectedAgentId)->first();
            echo json_encode($data);
        }

// Existing code in the controller...


public function download_excel()
{
    // Define the path to your Excel file on the server
    $excelFilePath = ROOTPATH . 'CommonSheetForAgent.xlsx'; // Replace with your actual file path

    // Check if the file exists
    if (file_exists($excelFilePath)) {
        // Set the appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="CommonSheetForAgent.xlsx"');

        // Read and output the file contents
        readfile($excelFilePath);
    } else {
        // File not found, handle the error (e.g., show an error message)
        echo 'Excel file not found';
    }
}





    public function uploadindividualexcel()
    {
        if ($file = $this->request->getFile('file')) {
            
             $createdBy = $_SESSION['agent_name'];
             
            if ($file->isValid() && !$file->hasMoved()) {
                $bankname = $this->request->getPost('bankname');
                $agentid = $this->request->getPost('agentid');
                $agentname=$this->request->getPost('agentNameTextBox');
                //
                //  $modifiedBy = $_SESSION['agent_name'];
                $newName = $file->getRandomName();
                $file->move('../public/csvfile', $newName);

                // Load the Excel file
                $spreadsheet = IOFactory::load("../public/csvfile/" . $newName);
                $worksheet = $spreadsheet->getActiveSheet();

                $csvArr = [];

                foreach ($worksheet->getRowIterator() as $row) {
                    $rowData = [];
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    foreach ($cellIterator as $cell) {
                        $rowData[] = $cell->getValue();
                    }

                    if (count($rowData)) {
                        // Convert disbursaldate to the desired format
                        $disbursaldate = null;
                        if (!empty($rowData[5])) {
                            $dateValue = $rowData[5];
                            $dateObject = \DateTime::createFromFormat('d-M-y', $dateValue);
                            if ($dateObject) {
                                $disbursaldate = $dateObject->format('Y-m-d');
                            }
                        }

                        if (is_null($disbursaldate)) {
                            $disbursaldate = '0000-00-00'; // Assign a default value for null date
                        }
                        
                        // $agentname=$this->request->getPost('agentid');

                        $csvArr[] = [
                            'srno' => $rowData[0],
                            'aname'=>$agentid,
                            'branch' => $rowData[1],
                            'agreementno' => $rowData[2],
                            'customername' => $rowData[3],
                            'tenure' => $rowData[4],
                            'disbursaldate' => $disbursaldate,
                            'executive' => $rowData[6],
                            'state' => $rowData[7],
                            'bank' => $rowData[8],
                            'created_by' => $createdBy,
                            //  'modify_by' => $modifiedBy,
                        
                        ];
                    }
                }

                $count = 0;
                $individualagent = new IndividualLosModel();
                $agentModel = new AgentModel();
                $aname = $agentModel->findAll();
                $executives = [];
                
                $isFirstRow = true;
                
                
               foreach ($csvArr as $userdata) {
            $findRecord = $individualagent->where('agreementno', $userdata['agreementno'])->countAllResults();
            if ($isFirstRow) {
                $isFirstRow = false;
                continue;
            }
            if ($userdata['executive'] == $agentid || $userdata['executive'] == $agentname) {
                if ($findRecord == 0) {
                    // Check if "executive" field is empty
                    if (empty($userdata['executive'])) {
                        $userdata['executive'] = null; // Set the "executive" field to null if it is empty
                    }
        
                    $individualagent->insert($userdata);
                    $count++;
                    session()->setFlashdata('message', $count . ' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    $duplicateAgent = $individualagent->where('agreementno', $userdata['agreementno'])->first();
                    // Collect duplicate agreement numbers, agent names, and agent IDs
                    $duplicateAgreementNos[$userdata['agreementno']] = [
                        'agentName' => $duplicateAgent['aname'],
                        'agentId' => $duplicateAgent['executive']
                    ];
                }
            } else {
                session()->setFlashdata('message', 'Executive Name not matched');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        
        if ($count > 0) {
            session()->setFlashdata('message', $count . ' rows successfully added.');
            session()->setFlashdata('alert-class', 'alert-success');
        }
        
        if (!empty($duplicateAgreementNos)) {
            $duplicateAgreementsMessage = 'Agreement numbers already exist for the following agents:<br>';
        
            // Concatenate the agreement numbers, agent names, and agent IDs in the error message
            foreach ($duplicateAgreementNos as $agreementNo => $agentData) {
                $duplicateAgreementsMessage .= 'Agent Name: ' . $agentData['agentName'] . ', Agent ID: ' . $agentData['agentId'] . ', already assigned to Agreement No: ' . $agreementNo . '<br>';
            }
        
            session()->setFlashdata('message', $duplicateAgreementsMessage);
            session()->setFlashdata('alert-class', 'alert-danger');
        }

                
                
        } else {
            session()->setFlashdata('message', 'Excel file could not be imported.');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->to(base_url('/agentindividualadmin/displayagent'));
    }
    }
    
    
    

}

?>