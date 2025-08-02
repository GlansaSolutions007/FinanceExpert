<?php

    namespace App\Controllers;
    use App\Models\AgentModel;
    use App\Models\CommonModel;
    use CodeIgniter\Controller;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Exception;

    
    class applicationReportController extends BaseController
    {
        protected $model;
        public  function __construct()
        {
            helper(['url','form']);
            $this->model = new CommonModel();
            // $this->subAgentModel =  new SubAgentModel();
        }
        
        public function getEmailByAgentId($agentId)
    {

           
                $agentModel = new AgentModel();
                // $agent = $agentModel->find($agentID);
                $agent = $agentModel->where('user_id', $agentId)->first();

                // Return the agent name as a JSON response
                return $this->response->setJSON($agent);
                
            
    }
        
        public function getApplicationReport()
        {   
            $data['agents'] = $this->model->getDistinctAgentId();
             $data['bankNames'] = $this->model->getDistinctBankNames();
            return view('pages/applicationReports', $data);
        }
        
        
        public function getDataByAgentId()
        {
             $agentId = $this->request->getPost('agentId'); // Get the selected agent ID
            $data['agentData'] = $this->model->getDataByAgentId($agentId); // Modify this based on your model method
            
            return json_encode($data['agentData']);
        }
        
        public function getDataByBankName()
        {
            $bankName = $this->request->getVar('bankName');
            $data['bankData'] = $this->model->getDataByBank($bankName);
            
            return json_encode($data['bankData']); // Corrected variable name '$bankData'
        }
        
        
        public function getDataByLosNoLike()
        {
            $losNo = $this->request->getPost('losNo');
            $data['losData'] = $this->model->getDataByLosNoLike($losNo); // Modify this based on your model method
            
            return json_encode($data['losData']);
        }
        
        
        public function getDataBetweenDatesLos()
        {
            $fromDate = $this->request->getPost('fromDate');
            $toDate = $this->request->getPost('toDate');
            $data['dateRangeData'] = $this->model->getDataBetweenDatesLos($fromDate, $toDate); // Modify this based on your model method
            
            return json_encode($data['dateRangeData']);
        }
        
        public function getDataByAgentAndLos()
        {
            $agentId = $this->request->getPost('agentId');
            $losNo = $this->request->getPost('losNo');
            $data['agentlosdata'] = $this->model->getDataByAgentAndLos($agentId, $losNo); // Modify this based on your model method
            
            return json_encode($data['agentlosdata']);
        }
        
        public function getDataByBankAndLos()
        {
            $bankName = $this->request->getVar('bankName');
            $losNo = $this->request->getVar('losNo');
            $data['banklosdata'] = $this->model->getDataByBankAndLos($bankName, $losNo); // Modify this based on your model method
            
            return json_encode($data['banklosdata']);
        }
        
        public function getDataByfromToDateAndLos()
        {
            $fromDate = $this->request->getVar('fromDate');
            $toDate =  $this->request->getVar('toDate');
            $losNo = $this->request->getVar('losNo');
            $data['fromtolosdata'] = $this->model->getDataByfromToDateAndLos($fromDate,$toDate, $losNo); // Modify this based on your model method
            
            return json_encode($data['fromtolosdata']);
        }
        
         public function getDataByAgentAndBank()
        {
            $agentId = $this->request->getVar('agentId');
            $bankName =  $this->request->getVar('bankName');
            $data['agentBankData'] = $this->model->getDataByAgentAndBank($agentId,$bankName); // Modify this based on your model method
            
            return json_encode($data['agentBankData']);
        }

        public function getDataByAgentAndFromToDate()
        {
            $agentId = $this->request->getVar('agentId');
            $fromDate =  $this->request->getVar('fromDate');
            $toDate = $this->request->getVar('toDate');
            $data['agentFromToData'] = $this->model->getDataByAgentAndFromToDate($agentId,$fromDate, $toDate); // Modify this based on your model method
            
            return json_encode($data['agentFromToData']);
        }
        
        
        public function getDataByBankAndFromToDate()
        {
            $bankName = $this->request->getVar('bankName');
            $fromDate =  $this->request->getVar('fromDate');
            $toDate = $this->request->getVar('toDate');
            $data['bankFromToData'] = $this->model->getDataByBankAndFromToDate($bankName,$fromDate, $toDate); // Modify this based on your model method
            
            return json_encode($data['bankFromToData']);
        }
        
        public function getDataByFromToLosAgent()
        {
            $fromDate = $this->request->getVar('fromDate');
            $toDate = $this->request->getVar('toDate');
            $losNo =  $this->request->getVar('losNo');
            $agentId = $this->request->getVar('agentId');
            $data['LosAgentFromToData'] = $this->model->getDataByFromToLosAgent($fromDate,$toDate,$losNo, $agentId); // Modify this based on your model method
            
            return json_encode($data['LosAgentFromToData']);
        }
        
        public function getDataByBankLosAgent()
        {
            $bankName = $this->request->getVar('bankName');
            $losNo =  $this->request->getVar('losNo');
            $agentId = $this->request->getVar('agentId');
            $data['LosAgentBankData'] = $this->model->getDataByBankLosAgent($bankName,$losNo, $agentId); // Modify this based on your model method
            
            return json_encode($data['LosAgentBankData']);
        }
        
        public function getDataByBankAgentFromToDate()
        {
            $bankName = $this->request->getVar('bankName');
            $fromDate =  $this->request->getVar('fromDate');
            $toDate =  $this->request->getVar('toDate');
            $agentId = $this->request->getVar('agentId');
            $data['FromToDateAgentBankData'] = $this->model->getDataByBankAgentFromToDate($bankName,$fromDate, $toDate, $agentId); // Modify this based on your model method
            
            return json_encode($data['FromToDateAgentBankData']);
        }
        
        
        public function getDataByBankLosFromToDate()
        {
            $bankName = $this->request->getVar('bankName');
            $fromDate =  $this->request->getVar('fromDate');
            $toDate =  $this->request->getVar('toDate');
            $losNo = $this->request->getVar('losNo');
            $data['FromToDateLosBankData'] = $this->model->getDataByBankLosFromToDate($bankName,$fromDate, $toDate, $losNo); // Modify this based on your model method
            
            return json_encode($data['FromToDateLosBankData']);
        }
        
        public function getAllData()
        {
            $bankName = $this->request->getVar('bankName');
            $agentId = $this->request->getVar('agentId');
            $fromDate =  $this->request->getVar('fromDate');
            $toDate =  $this->request->getVar('toDate');
            $losNo = $this->request->getVar('losNo');
            $data['allData'] = $this->model->getAllData($bankName,$fromDate, $toDate, $losNo, $agentId); // Modify this based on your model method
            
            return json_encode($data['allData']);
        }
        

        public function exportToExcel()
        {
        try {
            $agentId = $this->request->getVar('agentId');
            $fromDate = $this->request->getVar('fromDate');
            $toDate = $this->request->getVar('toDate');
            $email = $this->request->getVar('email');
    
            $this->model = new CommonModel(); // Change this to your model
            $data = $this->model->getAgentExportDatas($agentId, $fromDate, $toDate);
    
            if (!empty($data)) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet(0);
    
                // Add headers
                $sheet->setCellValue('A1', 'Sno.');
                $sheet->setCellValue('B1', 'Agreement No');
                $sheet->setCellValue('C1', 'Bank Name');
                $sheet->setCellValue('D1', 'Disbursal Date');
                $sheet->setCellValue('E1', 'Customer Name');
                $sheet->setCellValue('F1', 'Location');
                $sheet->setCellValue('G1', 'State');
                $sheet->setCellValue('H1', 'Gross No');
                $sheet->setCellValue('I1', 'Topup');
                $sheet->setCellValue('J1', 'Scheme');
                $sheet->setCellValue('K1', 'Net');
                $sheet->setCellValue('L1', 'Loan Amount');
                $sheet->setCellValue('M1', 'Category');
                $sheet->setCellValue('N1', 'Payout %');
                $sheet->setCellValue('O1', 'WFH Deduction');
                $sheet->setCellValue('P1', 'Net %');
                $sheet->setCellValue('Q1', 'Gross Payout');
                $sheet->setCellValue('R1', 'TDS');
                $sheet->setCellValue('S1', 'Net Payment');
                $sheet->setCellValue('T1', 'Executive');
    
                // Add data rows
                $row = 2;
                $index = 1;
                foreach ($data as $item) {
                    $sheet->setCellValue('A' . $row, $index);
                    $sheet->setCellValue('B' . $row, $item['AgreementNo']);
                    $sheet->setCellValue('C' . $row, $item['Bank']);
                    $sheet->setCellValue('D' . $row, $item['DisbursalDate']);
                    $sheet->setCellValue('E' . $row, $item['CustomerName']);
                    $sheet->setCellValue('F' . $row, $item['Location']);
                    $sheet->setCellValue('G' . $row, $item['State']);
                    $sheet->setCellValue('H' . $row, $item['Gross']);
                    $sheet->setCellValue('I' . $row, $item['TopUp']);
                    $sheet->setCellValue('J' . $row, $item['Scheme']);
                    $sheet->setCellValue('K' . $row, $item['Net']);
                    $sheet->setCellValue('L' . $row, $item['LoanAmount']);
                    $sheet->setCellValue('M' . $row, $item['Category']);
                    $sheet->setCellValue('N' . $row, $item['PayOutPercentage']);
                    $sheet->setCellValue('O' . $row, $item['WfhDeduction']);
                    $sheet->setCellValue('P' . $row, $item['NetPercentage']);
                    $sheet->setCellValue('Q' . $row, $item['GrossPayout']);
                    $sheet->setCellValue('R' . $row, $item['TDS']);
                    $sheet->setCellValue('S' . $row, $item['NetPayment']);
                    $sheet->setCellValue('T' . $row, $item['Executive']);
                    $row++;
                    $index++;
                }
                $savePath = WRITEPATH . 'uploads/MisExport/';
            $filename = 'MisController' . date('YmdHis') . '.xlsx';
            $fullPath = $savePath . $filename;

            // Check if the directory exists, create it if not
            if (!is_dir($savePath)) {
                mkdir($savePath, 0777, true);
            }

            // Save the Excel file
            $writer = new Xlsx($spreadsheet);
            $writer->save($fullPath);

            if (file_exists($fullPath)) {
                // Use the Services class to get an instance of the Email library
                $emailLib = \Config\Services::email();

                // Send email with the Excel file attached
                $emailLib->setFrom('anita.glansa@gmail.com', 'Anita');
                $emailLib->setTo($email);
                $emailLib->setSubject('Exported Excel File');
                $emailLib->setMessage('Please find the attached Excel file.');

                // Use attach instead of attachPath
                $emailLib->attach($fullPath);

                if ($emailLib->send()) {
                    // Add debug information
                    error_log('Email sent successfully');
                    return $this->response->setJSON(['success' => true, 'file_path' => $fullPath, 'email_sent' => true]);
                } else {
                    // Add debug information
                    error_log('Email sending failed: ' . $emailLib->printDebugger());
                    return $this->response->setJSON(['success' => false, 'error' => $emailLib->printDebugger()]);
                }
            } else {
                return $this->response->setJSON(['success' => false, 'error' => 'File was not saved.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'error' => 'No data to export.']);
        }
    } catch (\Exception $e) {
        // Add debug information
        error_log('Error exporting Excel: ' . $e->getMessage() . ' | ' . $e->getTraceAsString());
        return $this->response->setJSON(['success' => false, 'error' => 'An error occurred during export.']);
    }
}



public function export()
{
    try {
        $agentId = $this->request->getVar('agentId');
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('toDate');
        $losNo = $this->request->getVar('losNo');
        $bankName = $this->request->getVar('bankName');

        // Instantiate the CommonModel
        $this->model = new CommonModel();

        // Fetch data based on parameters
        $data = $this->model->getAgentExportDatass($agentId, $fromDate, $toDate, $losNo, $bankName);

        if (!empty($data)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Add headers
            $sheet->setCellValue('A1', 'Sno');
            $sheet->setCellValue('B1', 'Executive');
            $sheet->setCellValue('C1', 'Agreement No');
            $sheet->setCellValue('D1', 'Bank Name');
            $sheet->setCellValue('E1', 'Disbursal Date');
            $sheet->setCellValue('F1', 'Customer Name');
            $sheet->setCellValue('G1', 'Location');
            $sheet->setCellValue('H1', 'State');
            $sheet->setCellValue('I1', 'Gross No');
            $sheet->setCellValue('J1', 'Topup');
            $sheet->setCellValue('K1', 'Scheme');
            $sheet->setCellValue('L1', 'Net');
            $sheet->setCellValue('M1', 'Loan Amount');
            $sheet->setCellValue('N1', 'Category');
            $sheet->setCellValue('O1', 'Payout %');
            $sheet->setCellValue('P1', 'WFH Deduction');
            $sheet->setCellValue('Q1', 'Net %');
            $sheet->setCellValue('R1', 'Gross Payout');
            $sheet->setCellValue('S1', 'TDS');
            $sheet->setCellValue('T1', 'Net Payment');

            // Add data rows
            $row = 2;
            $index = 1;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $index);
                $sheet->setCellValue('B' . $row, $item['Executive']);
                $sheet->setCellValue('C' . $row, $item['AgreementNo']);
                $sheet->setCellValue('D' . $row, $item['Bank']);
                $sheet->setCellValue('E' . $row, $item['DisbursalDate']);
                $sheet->setCellValue('F' . $row, $item['CustomerName']);
                $sheet->setCellValue('G' . $row, $item['Location']);
                $sheet->setCellValue('H' . $row, $item['State']);
                $sheet->setCellValue('I' . $row, $item['Gross']);
                $sheet->setCellValue('J' . $row, $item['TopUp']);
                $sheet->setCellValue('K' . $row, $item['Scheme']);
                $sheet->setCellValue('L' . $row, $item['Net']);
                $sheet->setCellValue('M' . $row, $item['LoanAmount']);
                $sheet->setCellValue('N' . $row, $item['Category']);
                $sheet->setCellValue('O' . $row, $item['PayOutPercentage']);
                $sheet->setCellValue('P' . $row, $item['WfhDeduction']);
                $sheet->setCellValue('Q' . $row, $item['NetPercentage']);
                $sheet->setCellValue('R' . $row, $item['GrossPayout']);
                $sheet->setCellValue('S' . $row, $item['TDS']);
                $sheet->setCellValue('T' . $row, $item['NetPayment']);

                $row++;
                $index++;
            }

            // Create the Excel file
            $writer = new Xlsx($spreadsheet);

            // Set headers for download
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="ApplicationReport_' . date('Y-m-d_H:i:s') . '.xlsx"');
            header('Cache-Control: max-age=0');

            // Output the file
            $writer->save('php://output');
            exit;
        } else {
            return $this->response->setJSON(['error' => 'No data found between the selected dates.']);
        }
    } catch (Exception $e) {
        // Handle or log the exception here
        return $this->response->setJSON(['error' => $e->getMessage()]);
    }
}

}