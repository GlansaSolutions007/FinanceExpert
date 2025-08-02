<?php

namespace App\Controllers;

use App\Models\CommonModel;
use App\Models\UserModel;
use App\Models\AgentModel;
use App\Models\IndividualLosModel;
use App\Models\Paymentmodel;
use App\Models\EmiModel;
use App\Models\EmiRecoveryModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Exception;



use CodeIgniter\Controller;


class agentwisecontroller extends BaseController
{
    protected $commonModel;
    protected $userModel;
    protected $agentModel;
    protected $emiModel;
    protected $emiRecoveryModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->commonModel = new CommonModel();
        $this->userModel = new UserModel();
        $this->agentModel = new AgentModel();
        $this->emiModel = new EmiModel();
        $this->emiRecoveryModel = new EmiRecoveryModel();

    }

    public function exportToExcel()
    {
        try {
            $agentId = $this->request->getVar('agentId');
            $fromDate = $this->request->getVar('fromDate');
            $toDate = $this->request->getVar('toDate');

            $data = $this->emiModel->getAgentExportData($agentId, $fromDate, $toDate);

            if (!empty($data)) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                // Add headers
                $sheet->setCellValue('A1', 'Sno.');
                $sheet->setCellValue('B1', 'Agent Name');
                $sheet->setCellValue('C1', 'Loan Amount');
                $sheet->setCellValue('D1', 'Duration in Month');
                $sheet->setCellValue('E1', 'Monthly Emi');
                $sheet->setCellValue('F1', 'Remaining Debt Amount');
                $sheet->setCellValue('G1', 'Date');
                $sheet->setCellValue('H1', 'Voucher Number');

                // Add data rows
                $row = 2;
                $index = 1;
                foreach ($data as $item) {
                    $sheet->setCellValue('A' . $row, $index);
                    $sheet->setCellValue('B' . $row, $item['agentName']);
                    $sheet->setCellValue('C' . $row, $item['loanAmount']);
                    $sheet->setCellValue('D' . $row, $item['month']);
                    $sheet->setCellValue('E' . $row, $item['monthlyEmi']);
                    $sheet->setCellValue('F' . $row, $item['remainingDebtAmount']);
                    $sheet->setCellValue('G' . $row, $item['date']);
                    $sheet->setCellValue('H' . $row, $item['voucher']);
                    $row++;
                    $index++;
                }

                // Create the Excel file
                $writer = new Xlsx($spreadsheet);

                // Generate a temporary file path
                $filename = 'AgentLoan_' . date('Y-m-d_H:i:s') . '.xlsx';
                $temp_file = tempnam(sys_get_temp_dir(), $filename);
                $writer->save($temp_file);

                // Return the file as a response for download
                return $this->response->download($temp_file, null)
                    ->setFileName($filename)
                    ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            } else {
                return $this->response->setJSON(['error' => 'No data found between the selected dates.']);
            }
        } catch (Exception $e) {
            // Handle or log the PhpSpreadsheet Writer exception here
            return $this->response->setJSON(['error' => $e->getMessage()]);
        } catch (Exception $e) {
            // Handle or log any other exceptions here
            return $this->response->setJSON(['error' => $e->getMessage()]);
        }
    }
        public function agentname()
    {
        $agentModel = new AgentModel();
        $data['agent_id'] = $agentModel->findAll();
        return view('pages/agent-report', $data);
        // return view('pages/agent-report'); // Assuming the view file is named 'import-csv.php'
    }

    public function bankname()
    {
        $this->usermodel = new UserModel();
        $data['banks'] = $this->userModel->findAll();
        $data['branch'] = $this->userModel->findAll();
        // $data['agents'] = $this->agentModel->findAll();
        return view('pages/bank-report', $data);
        // return view('pages/agent-report'); // Assuming the view file is named 'import-csv.php'
    }

    public function lossheet()
    {
        $this->commonModel = new CommonModel();
        $data['los'] = $this->commonModel->findAll();
        return view('pages/LOS-search', $data);
        // return view('pages/agent-report'); // Assuming the view file is named 'import-csv.php'
    }

    public function customersheet()
    {
        $this->commonModel = new CommonModel();
        $data['customer'] = $this->commonModel->findAll();
        return view('pages/c-name-search', $data);
        // return view('pages/agent-report'); // Assuming the view file is named 'import-csv.php'
    }
    public function branchsheet()
    {
        $this->userModel = new UserModel();
        $data['branch'] = $this->userModel->findAll();
        return view('pages/b-b-search', $data);
        // return view('pages/agent-report'); // Assuming the view file is named 'import-csv.php'
    }

    public function comparedate()
    {
        $fromDate = $this->request->getVar('fromdate');
        $toDate = $this->request->getVar('todate');
        $agentName = $this->request->getVar('agentname');

        // Log input values for debugging
        log_message('debug', 'From Date: ' . $fromDate);
        log_message('debug', 'To Date: ' . $toDate);
        log_message('debug', 'Agent Name: ' . $agentName);

        $this->commonModel = new CommonModel();
        $data = $this->commonModel->getDataBetweenDate($fromDate, $toDate, $agentName);

        return $this->response->setJSON($data);
    }


    public function agentLoanReports()
    {
        $this->emiModel = new EmiModel();
        $data['emis'] = $this->emiModel->distinct()->select('agent_id')->findAll();
        return view('pages/agentLoanReports', $data);
    }


    public function getAgentName()
    {
        $agentId = $this->request->getVar('selectedAgentID');
        $this->emiModel = new EmiModel();
        $data = $this->emiModel->where('agent_id', $agentId)->first();
        echo json_encode($data); // Use 'echo' instead of 'return'
    }

    public function getAgentLoanData()
    {
        $agentId = $this->request->getVar('agentId');
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('toDate');

        $this->emiModel = new EmiRecoveryModel();
        $data = $this->emiModel->getAgentLoanData($agentId, $fromDate, $toDate);

        echo json_encode($data);
    }


    public function comparedateBank()
    {

        $bankName = $this->request->getPost('bankname');

        $this->commonModel = new CommonModel();
        $data = $this->commonModel->getDataBetweenDateBank($bankName);

        return $this->response->setJSON($data);


    }

}