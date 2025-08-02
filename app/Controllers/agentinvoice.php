<?php
namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\AgentModel;
    use App\Models\CommonModel;
    use App\Models\Paymentmodel;
    use App\Models\GenerateInvoiceModel;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use COdeigniter\Controller;
    use PhpOffice\PhpSpreadsheet\Writer\Exception;

    require_once 'dompdf/autoload.inc.php'; 
     
    // Reference the Dompdf namespace 
    use Dompdf\Dompdf; 
    use Dompdf\Options;

    class agentinvoice extends BaseController
    {
        // use ResponseTrait;
        public function __construct()
        {
            $this->model = new UserModel();
            $this->agents = new AgentModel();
            $this->commonModel = new CommonModel();
            $this->payment = new Paymentmodel();
        } 
    public function savePdf()
    {
        // Get the HTML content and email from the POST data
        $htmlContent = $this->request->getPost('htmlContent');
        $email = $this->request->getPost('email');
    
        $cssStyles = '
            <style>
                table {
                    width: 95%;
                }
                th, td {
                    border: 1px solid #ededed;
                    padding: 3px;
                    text-align: left;
                    border-collapse: collapse;
                }
                h3 {
                    font-size: 20px;
                }
            </style>
        ';
    
        // Concatenate the image source in the HTML content
        $htmlContent = '<meta charset="UTF-8">' . $cssStyles . $htmlContent;

        $htmlContent = str_replace('?', '₹', $htmlContent);

    
        // Configure Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

    
        // Initialize Dompdf
        $dompdf = new Dompdf($options);
    
        // Enable remote file access
        // $dompdf->set_option('isRemoteEnabled', true);
    
        // Load HTML content into Dompdf
        $dompdf->loadHtml($htmlContent);
    
        // Set paper size to A4 with a fixed height
        $dompdf->setPaper('A4', 'portrait');
    
        // Render the PDF
        $dompdf->render();
    
        // Specify the path to save the PDF
        $pdfPath = WRITEPATH . 'uploads/Invoice-Report/invoice.pdf';
    
        // Save the PDF to the specified path
        file_put_contents($pdfPath, $dompdf->output());
    
        // Send email with the saved PDF as an attachment
        if ($this->sendEmail($email, $pdfPath)) {
            // Respond to the client with the path to the saved PDF
            return $this->response->setJSON(['pdf_path' => $pdfPath]);
        } else {
            // Get detailed debug info
            $emailLibrary = \Config\Services::email();
            $debugInfo = $emailLibrary->printDebugger(['headers', 'subject', 'body']);
            
            // Log the error message
            log_message('error', 'Email sending failed: ' . $debugInfo);

            // Return the debug info in JSON (for development only)
            return $this->response->setJSON([
                'error' => 'Failed to send email',
                'debug' => $debugInfo
            ]);
        }
    }


    public function sendEmail($to, $attachmentPath)
{
    try {
        // Load the email service
        $email = \Config\Services::email();

        // Set email parameters
        $email->setTo($to);
        $email->setFrom('soumya05ranjan@gmail.com', 'FinExpert');
        $email->setSubject('Invoice PDF Attached');
        $email->setMessage("Please find the attached invoice PDF.");

        // Attach the PDF
        $email->attach($attachmentPath);

        // Attempt to send email
        if ($email->send()) {
            log_message('info', 'Email sent successfully to ' . $to);
            return true;
        } else {
            // Log email debug info
            $debug = $email->printDebugger(['headers', 'subject', 'body']);
            log_message('error', 'Email failed to send. Debug info: ' . print_r($debug, true));
            return false;
        }

    } catch (\Exception $e) {
        // Catch and log any exceptions
        log_message('error', 'Email Exception: ' . $e->getMessage());
        return false;
    }
}

    
    public function exportToExcel()
{
    try {
        $agentId = $this->request->getVar('agentId');
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('toDate');

        $this->paymentmodel = new Paymentmodel(); // Change this to your model
        $data = $this->paymentmodel->getAgentExportData($agentId, $fromDate, $toDate);

        if (!empty($data)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Add headers
            $sheet->setCellValue('A1', 'Sno.');
            $sheet->setCellValue('B1', 'Transaction Id');
            $sheet->setCellValue('C1', 'Transaction Date');
            $sheet->setCellValue('D1', 'Transaction Amount');
            $sheet->setCellValue('E1', 'GST');
            $sheet->setCellValue('F1', 'Voucher');

            // Add data rows
            $row = 2;
            $index = 1;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $index);
                $sheet->setCellValue('B' . $row, $item['transaction_id']);
                $sheet->setCellValue('C' . $row, $item['transaction_date']);
                $sheet->setCellValue('D' . $row, $item['payment_amount']);
                $sheet->setCellValue('E' . $row, $item['gst_no']);
                $sheet->setCellValue('F' . $row, $item['voucher']);
                $row++;
                $index++;
            }

            // Create the Excel file
            $writer = new Xlsx($spreadsheet);

            // Set the response headers to trigger a download
            $filename = 'AgentInvoice' . date('Y-m-d_H:i:s') . '.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $filename);
            $writer->save($temp_file);

            // Return the file as a response for download
            return $this->response->download($temp_file, null)->setFileName($filename)->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        } else {
            return $this->response->setJSON(['error' => 'No data found between the selected dates.']);
        }
    } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
        // Handle or log the PhpSpreadsheet Writer exception here
        return $this->response->setJSON(['error' => $e->getMessage()]);
    } catch (\Exception $e) {
        // Handle or log any other exceptions here
        return $this->response->setJSON(['error' => $e->getMessage()]);
    }
}

        
        public function display()
        {
            $bankData['banks'] = $this->model->findAll();
            $agentData['agents'] = $this->agents->findAll();

            $data = array_merge($bankData, $agentData);
            
            return view('pages/agent-invoice-report', $data);

        }
       
         public function taxinvoice()
        {
            $data['agents'] = $this->commonModel->groupBy('Executive')->findAll();
            return view('pages/tax_invoice', $data);
        }
        
        
        public function agentInvoice()
        {
            $data['agents'] = $this->commonModel->groupBy('Executive')->findAll();
            return view('pages/gen_agent_invoice', $data);
        }
        
        
         public function comparedates()
         
           {
                $fromDate = $this->request->getVar('fromdate');
                $toDate = $this->request->getVar('todate');
                $agentName = $this->request->getVar('agentname');
            
                // Log input values for debugging
                 log_message('debug', 'From Date: ' . $fromDate);
                 log_message('debug', 'To Date: ' . $toDate);
                 log_message('debug', 'Agent Name: ' . $agentName);
                        
                $this->payment = new Paymentmodel();
                $data = $this->payment->getDataBetweenDate($fromDate, $toDate, $agentName);
            
                return $this->response->setJSON($data);
            }

            public function comparedate()
            {
                $fromDate = $this->request->getVar('fromdate');
                $toDate = $this->request->getVar('todate');
                $agentId = $this->request->getVar('agentname');
            
                // Create an instance of the Paymentmodel
                $this->payment = new Paymentmodel();
                $db = db_connect(); // Assuming you are using CodeIgniter 4
                
                // Fetch data from sub_agent table
                $subAgentData = $db->table('sub_agent')
                                   ->select('sub_agent.name, sub_agent.gst_no ,sub_agent.address') // Select both name and gst_no
                                   ->join('agent_master', 'agent_master.id = sub_agent.agent_id')
                                   ->where('agent_master.user_id', $agentId)
                                   ->get()
                                   ->getResultArray();
            
                // Fetch data using getDataByAgentIdWithSums method from Paymentmodel
                $paymentData = $this->payment->getDataByAgentIdWithSums($agentId, $fromDate, $toDate);
                
                
            
                // Combine both sets of data into a single array
                $result = [
                    'sub_agent_data' => $subAgentData,
                    'payment_data' => $paymentData
                ];
            
                // Return the combined data as a JSON response
                return $this->response->setJSON($result);
            }


        
            public function getAgentName($agentId)
            {
                $agentModel = new AgentModel();
                // $agent = $agentModel->find($agentID);
                $agent = $agentModel->where('user_id', $agentId)->first();

                // Return the agent name as a JSON response
                return $this->response->setJSON($agent);
                
            }
            
   public function getRowData($rowId)
    {
        $this->payment = new Paymentmodel();
        $data = $this->payment->where('id', $rowId)->first();

        return $this->response->setJSON($data);
    }     
    
    public function getGstNo()
    {
        $agentId = $this->request->getVar('agent_id');
        $subagentName = $this->request->getVar('subagentName');
        
        $this->agentModel = new AgentModel();
        $data = $this->agentModel->where('user_id', $agentId)->first();
        
        return $this->response->setJSON($data);
    }
    
    
    
    public function checkDuplicateData()
    {
        $agentId = $this->request->getVar('agentId');
        $fromdate = $this->request->getVar('fromDate');
        $todate = $this->request->getVar('toDate');
        
        $this->model = new GenerateInvoiceModel;
        $data['invoiceData'] = $this->model->restrictDuplicateInsert($agentId, $fromdate, $todate); // Modify this based on your model method
            
        return json_encode($data['invoiceData']);
        
    }
    
    public function insertInvoice()
    {
    // Retrieve the posted data
    $postData = $this->request->getPost('data');
         
     $subagentData = $postData['subagentData'] ?? [];

        $this->invoiceModel = new GenerateInvoiceModel();

        // $insertedAgentData = $this->invoiceModel->insertAgentData($agentData);

        $insertedSubagentData = [];
        if (!empty($subagentData)) {
            foreach ($subagentData as $subagent) {
                $insertedSubagentData[] = $this->invoiceModel->insertSubagentData($subagent);
            }
        }

        $allData = [
            // 'agentData' => $insertedAgentData,
            'subagentData' => $insertedSubagentData
        ];

        return $this->response->setJSON(['success' => true, 'data' => $allData]);
    }



    public function getInvoiceData()
    {
        $id = $this->request->getVar('id');
        
        $this->invoiceModel = new GenerateInvoiceModel();
        
        $data = $this->invoiceModel->where('id', $id)->first();
        return $this->response->setJSON($data);
        
    }

    public function checkDataExists()
    {
        // Get the parameters from the request
        $agentId = $this->request->getVar('agentId');
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('toDate');
        
        // Create an instance of the model
        $this->generateInvoiceModel = new GenerateInvoiceModel();
        
        // Call the model's method to check for existing data
        $existingData = $this->generateInvoiceModel->checkDataExists($agentId, $fromDate, $toDate);
        
        // Prepare the response data
        $responseData = [
            'dataExists' => !empty($existingData), // Check if existingData is not empty
            'existingData' => $existingData // Existing data retrieved from the model
        ];
        
        // Encode the response as JSON and return it
        return $this->response->setJSON($responseData);
    }
    

       public function getSubAgentName()
    {
        $userId = $this->request->getVar('userId'); // Get the user_id from the AJAX POST data
    
        $db = db_connect(); // Get a database connection instance
    
        $query = $db->table('sub_agent')
            ->select('sub_agent.name, sub_agent.gst_no') // Select both name and gst_no
            ->join('agent_master', 'agent_master.id = sub_agent.agent_id')
            ->where('agent_master.user_id', $userId)
            ->get();
    
        $results = $query->getResult();
    
        if (!empty($results)) {
            // Prepare the response with an array of subagent names and gst_no
            $subagents = [];
            foreach ($results as $row) {
                $subagents[] = [
                    'name' => $row->name,
                    'gst_no' => $row->gst_no
                ];
            }
            $response = ['subagents' => $subagents];
        } else {
            // No matching subagents found for the provided user_id
            $response = ['error' => 'No matching subagents found'];
        }
    
        // Set the Content-Type header and encode the response as JSON
        return $this->response->setJSON($response)->setStatusCode(200);
    }
}