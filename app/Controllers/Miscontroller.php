<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AgentModel;
use App\Models\CommonModel;
use COdeigniter\Controller;
class Miscontroller extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->agents = new AgentModel();
        $this->commonModel = new CommonModel();
        $this->db = \Config\Database::connect();
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
                $baseURL = 'https://example.com/'; // Replace with the actual base URL of your CodeIgniter app
                $savePath = 'writable/uploads/MisExport/';
                $filename = 'MIS' . date('Y-m-d_H:i:s') . '.xlsx';

                $fullPath = $savePath . $filename; // Just the path within your site

                // Save the Excel file
                $writer = new Xlsx($spreadsheet);
                $writer->save($fullPath);

                if (file_exists($fullPath)) {
                    $file_url = $baseURL . $fullPath; // Construct the full URL
                    return $this->response->setJSON(['success' => true, 'file_path' => $file_url]);
                } else {
                    return $this->response->setJSON(['success' => false, 'error' => 'File was not saved.']);
                }


            }
        } catch (Exception $e) {
            error_log('Error exporting Excel: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'An error occurred during export.']);
        }
    }




    public function bankdisplay()
    {
        $bankData['banks'] = $this->model->findAll();
        $agentData['agents'] = $this->agents->findAll();
        $data = array_merge($bankData, $agentData);
        return view('pages/mis-calculations', $data);

    }
    public function getDataByAgentFromToDate()
    {
        $this->model = new CommonModel();
        $agentId = $this->request->getVar('agentId');
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('toDate');
        $data['agentFromToDateData'] = $this->model->getDataByAgentFromToDate($agentId, $fromDate, $toDate);
        return json_encode($data['agentFromToDateData']);
    }
    public function comparedate()
    {
        $bankname = $this->request->getPost('bankname');
        $fromdate = $this->request->getPost('fromdate');
        $todate = $this->request->getPost('todate');
        $agentname = $this->request->getPost('agentname');
        $model = new CommonModel();
        $data = $model->getComparisonData($bankname, $fromdate, $todate, $agentname);
        return $this->response->setJSON($data);
    }

    public function getAgentName($agentId)
    {
        $agentModel = new AgentModel();
        // $agent = $agentModel->find($agentID);
        $agent = $agentModel->where('user_id', $agentId)->first();

        // Return the agent name as a JSON response
        return $this->response->setJSON($agent);

    }


    public function editmis($id)
    {
        $model = new CommonModel();
        // $agent = $agentModel->find($agentID);
        $data = $model->where('id', $id)->first();
        // Return the agent name as a JSON response
        return json_encode($data);
    }

    public function getAgentData()
    {
        $selectedBankName = $this->request->getPost('bankname');
        $userModel = new UserModel();
        $agentData = $userModel->where('name', $selectedBankName)->first();
        if ($agentData) {
            $response = [
                'success' => true,
                'data' => $agentData,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Agent not found.',
            ];
        }

        return $this->response->setJSON($response);
    }

    public function getPayoutPercentage()
    {
        $agentId = $this->input->post('agentId');
        $category = $this->input->post('category');
        // Assuming you have a model to interact with the database, load it here
        $this->agents = new AgentModel();

        // Call a method in your model to fetch the payout percentage
        $payoutPercentage = $this->agents->getPayoutPercentage($agentId, $category);

        // Return the payout percentage as JSON
        $response = array('payoutPercentage' => $payoutPercentage);
        echo json_encode($response);
    }

    public function updateMis()
    {
        $id = $this->request->getVar('id');
        $payout = $this->request->getVar('payout');
        $wfh = $this->request->getVar('wfh');
        $net = $this->request->getVar('net');
        $grosspayout = $this->request->getVar('grosspayout');
        $tds = $this->request->getVar('tds');
        $netpayment = $this->request->getVar('netpayment');

        $data['WfhDeduction'] = $wfh;
        $data['NetPercentage'] = $net;
        $data['PayOutPercentage'] = $payout;
        $data['GrossPayout'] = $grosspayout;
        $data['TDS'] = $tds;
        $data['NetPayment'] = $netpayment;

        // Update the data in the database
        $update = $this->commonModel->update($id, $data);

        if ($update) {
            // Retrieve the updated data from the database
            $updatedData = $this->commonModel->where('id', $id)->get()->getRowArray();

            // Set flash messages
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Update successfully.');

            // Return the updated data in JSON format
            return $this->response->setJSON($updatedData);
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
            // Return an error response if the update fails
            return $this->response->setJSON(['error' => 'Update failed']);
        }
    }

    public function getAgentBank()
    {
        $agentId = $this->request->getVar('agentId');
        $fromdate = $this->request->getVar('fromDate');
        $todate = $this->request->getVar('todate');
        // Execute the SQL query with rounding the payout percentages to 2 decimal places
        $query = $this->db->query("
                SELECT Bank,
                       ROUND(MAX(CASE WHEN Category = 'PVT' THEN PayOutPercentage ELSE NULL END), 2) AS PvtPayOutPercentage,
                       ROUND(MAX(CASE WHEN Category = 'SEP' THEN PayOutPercentage ELSE NULL END), 2) AS SepPayOutPercentage,
                       ROUND(MAX(CASE WHEN Category = 'GOVT' THEN PayOutPercentage ELSE NULL END), 2) AS GovtPayOutPercentage
                FROM los_master
                WHERE Executive = ? 
                AND DisbursalDate BETWEEN ? AND ? 
                AND Category IN ('PVT', 'SEP', 'GOVT')
                GROUP BY Bank
            ", [$agentId, $fromdate, $todate]);

        // Return the results as JSON
        return $this->response->setJSON($query->getResult());
    }
    public function updateAgentGrossPayout()
    {
        $model = new CommonModel();
        // Get parameters from the request
        $agentId = $this->request->getVar('agentId');
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('todate');
        $bank = $this->request->getVar('bank');
        $pvt = $this->request->getVar('pvt');
        $govt = $this->request->getVar('govt');
        $sep = $this->request->getVar('sep');

        // SQL query to update payout% based on parameters
        $sql = "UPDATE los_master
            SET PayOutPercentage = 
                CASE 
                    WHEN Category = 'PVT' THEN ?
                    WHEN Category = 'GOVT' THEN ?
                    WHEN Category = 'SEP' THEN ?
                END
            WHERE Executive = ?
              AND Bank = ?
              AND DisbursalDate BETWEEN ? AND ?";

        // Execute the SQL query with parameters
        $this->db->query($sql, [$pvt, $govt, $sep, $agentId, $bank, $fromDate, $toDate]);

        // SQL query to update calculations
        $updateCalculations = "UPDATE los_master SET WfhDeduction = 0,
                                          NetPercentage = PayOutPercentage - WfhDeduction,
                                          GrossPayout = LoanAmount * (NetPercentage/100),
                                          TDS = GrossPayout * (5/100),
                                          NetPayment = GrossPayout - TDS";

        // Execute the SQL query to update calculations
        $model->query($updateCalculations);

        // Fetch updated data
        $updatedData = $model->where('Executive', $agentId)
            ->where('Bank', $bank)
            ->where('DisbursalDate BETWEEN ' . $fromDate . ' AND ' . $toDate)
            ->findAll();

        // Return updated data in JSON format
        return json_encode($updatedData);
    }
}