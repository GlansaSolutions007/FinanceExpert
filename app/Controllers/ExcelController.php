<?php

namespace App\Controllers;

use App\Models\CommonModel;
use App\Models\UserModel;
use App\Models\AgentModel;
use App\Models\IndividualLosModel;
use CodeIgniter\Controller;
use DateTime;
use App\config\Email;
// use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;


class ExcelController extends Controller
{
    public function __construct()
    {
        helper(['url', 'form']);
        $this->model = new CommonModel();
        $this->usermodel = new UserModel();
    }

    // public function viewmaster($id)
    // {
    //     $data['user'] = $this->model->findAll($id);
    //     return view('pages/view-master', $data);
    // }

    public function index()
    {
        return view('pages/upload-master-sheet'); // Assuming the view file is named 'import-csv.php'
    }


    public function download_excel()
    {
        // Define the path to your Excel file on the server
        $excelFilePath = ROOTPATH . 'CommonSheetForBank.xlsx'; // Replace with your actual file path

        // Check if the file exists
        if (file_exists($excelFilePath)) {
            // Set the appropriate headers for file download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="CommonSheetForBank.xlsx"');

            // Read and output the file contents
            readfile($excelFilePath);
        } else {
            // File not found, handle the error (e.g., show an error message)
            echo 'Excel file not found';
        }
    }


    public function importExcelToDb()
    {
        if ($file = $this->request->getFile('file')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $bankname = $this->request->getPost('bankname');
                $newName = $file->getRandomName();
                $file->move('../public/csvfile', $newName);
                $spreadsheet = IOFactory::load("../public/csvfile/" . $newName);
                $worksheet = $spreadsheet->getActiveSheet();
                $csvArr = [];

                foreach ($worksheet->getRowIterator() as $row) {
                    $rowData = [];
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    foreach ($cellIterator as $cell) {
                        if ($cell->getColumn() == 'C') {
                            $disbursalDate = $cell->getValue();
                            if (is_numeric($disbursalDate)) {
                                $disbursalDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($disbursalDate);
                                $disbursalDate = $disbursalDate->format('Y-m-d');
                                $rowData[] = $disbursalDate;
                            } else {
                                // Handle non-numeric values for dates (if necessary).
                                $rowData[] = null; // Or set a default date.
                            }
                        } else {
                            $rowData[] = $cell->getValue();
                        }
                    }

                    if (count($rowData)) {
                        $csvArr[] = [
                            'SrNo' => $rowData[0],
                            'AgreementNo' => $rowData[1],
                            'DisbursalDate' => $rowData[2],
                            'CustomerName' => $rowData[3],
                            'Bank' => $rowData[4],
                            'Location' => $rowData[5],
                            'State' => $rowData[6],
                            'Gross' => $rowData[7],
                            'TopUp' => $rowData[8],
                            'Net' => $rowData[9],
                            'LoanAmount' => $rowData[10],
                            'Scheme' => $rowData[11],
                            'Category' => $rowData[12],
                            'PayOutPercentage' => $rowData[13],
                            'WfhDeduction' => $rowData[14],
                            'NetPercentage' => $rowData[15],
                            'GrossPayout' => $rowData[16],
                            'TDS' => $rowData[17],
                            'NetPayment' => $rowData[18],
                            'Executive' => $rowData[19],
                            'sheetname' => $newName,
                            // 'created_by' => $createdBy,
                        ];
                    }
                }


                $count = 0;
                $students = new CommonModel();
                $agentModel = new AgentModel();
                $bankModel = new UserModel();
                $aname = $agentModel->findAll();
                $allBanksData = $bankModel->findAll();
                $executives = [];

                $individualAgentModel = new IndividualLosModel(); // Assuming this is the model for the individual agent data
                $individualAgentData = $individualAgentModel->findAll();

                // Iterate through each row of the whole master Excel sheet
                foreach ($csvArr as &$wholeMasterData) {
                    $wholeMasterAgreementNo = $wholeMasterData['AgreementNo'];

                    // Find the corresponding individual agent data based on the agreement ID
                    foreach ($individualAgentData as $individualAgent) {
                        if ($individualAgent['agreementno'] === $wholeMasterAgreementNo) {
                            // Match found, update the agent name in the whole master Excel data
                            $wholeMasterData['Executive'] = $individualAgent['aname']; // Assuming "aname" is the agent name field in the individual sheet
                            break; // Break the loop as we found the match
                        }
                    }
                }




                foreach ($csvArr as &$wholeMasterData) {
                    $bankName = $wholeMasterData['Bank'];
                    $location = $wholeMasterData['Location'];
                    $bankData = null;
                    $wholeMasterAgreementNo = $wholeMasterData['AgreementNo'];


                    foreach ($allBanksData as $bank) {
                        if ($bank['name'] === $bankName && $bank['branch'] === $location) {
                            $bankData = $bank;
                            break;
                        }
                    }


                    if ($bankData !== null) {
                        // Add the bank ID to the whole master data array
                        $wholeMasterData['bank_id'] = $bankData['id'];
                    } else {
                        // If bank data not found, you can handle it accordingly, like setting default values or skipping insertion.
                        // For example, you can set $wholeMasterData['bank_id'] = null; or any default value.
                    }

                    // Find the corresponding individual agent data based on the agreement ID
                    foreach ($individualAgentData as $individualAgent) {
                        if ($individualAgent['agreementno'] === $wholeMasterAgreementNo) {
                            // Match found, update the agent name in the whole master Excel data
                            $wholeMasterData['executive'] = $individualAgent['aname']; // Assuming "aname" is the agent name field in the individual sheet
                            break; // Break the loop as we found the match
                        }
                    }

                    // Check if "executive" field is empty
                    if (empty($wholeMasterData['Executive'])) {
                        $wholeMasterData['Executive'] = null; // Set the "executive" field to null if it is empty
                    }
                }

                $insertedCount = 0;
                $duplicateCount = 0;

                foreach ($csvArr as $userdata) {
                    $findRecord = $students->where('AgreementNo', $userdata['AgreementNo'])->countAllResults();

                    if ($findRecord == 0) {
                        if ($userdata['Bank'] === $bankname) {
                            $students->insert($userdata);
                            $insertedCount++;
                        }
                    } else {
                        $duplicateCount++;
                    }
                }

                // Set Flashdata messages AFTER the loop
                if ($insertedCount > 0 && $duplicateCount == 0) {
                    session()->setFlashdata('message', "$insertedCount rows successfully added.");
                    session()->setFlashdata('alert-class', 'alert-success');
                } elseif ($insertedCount > 0 && $duplicateCount > 0) {
                    session()->setFlashdata('message', "$insertedCount rows added. $duplicateCount already existed.");
                    session()->setFlashdata('alert-class', 'alert-warning');
                } elseif ($insertedCount == 0 && $duplicateCount > 0) {
                    session()->setFlashdata('message', 'Your chosen file is incorrect or already exists!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                } else {
                    session()->setFlashdata('message', 'Something went wrong. No data added.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            }

            $losModel = new CommonModel();

            // Update the PayOutPercentage in los_master based on agent_master values
            $updateQuery = "UPDATE los_master
                                        JOIN agent_master ON agent_master.user_id = los_master.Executive
                                        SET los_master.`PayOutPercentage` =
                                            CASE
                                                WHEN los_master.category = 'PVT' THEN agent_master.PVT
                                                WHEN los_master.category = 'GOVT' THEN agent_master.GOVT
                                                WHEN los_master.category = 'SEP' THEN agent_master.SEP
                                                ELSE los_master.`PayOutPercentage`
                                            END
                                        WHERE los_master.category IN ('PVT', 'GOVT', 'SEP')";

            // Run the update query using the model
            $losModel->query($updateQuery);

            $updateBankId = "UPDATE los_master
                                        JOIN bank_master ON bank_master.name = los_master.Bank AND bank_master.branch = los_master.Location
                                        SET los_master.BankId = bank_master.id
                                        WHERE los_master.Bank IS NOT NULL AND los_master.Location IS NOT NULL";
            $losModel->query($updateBankId);

            $updateCalculations = "UPDATE los_master SET WfhDeduction = 0,
                                                NetPercentage = PayOutPercentage - WfhDeduction,
                                                GrossPayout = LoanAmount * (NetPercentage/100),
                                                TDS = GrossPayout * (5/100),
                                                NetPayment = GrossPayout - TDS";

            $losModel->query($updateCalculations);

            return redirect()->to(base_url('/admin/uploadmaster'));
        }
    }

    public function viewmastersheet()
    {
        $this->usermodel = new UserModel();
        $this->agent = new AgentModel();
        $data['banks'] = $this->usermodel->findAll();
        $data['agents'] = $this->agent->findAll();
        return view('pages/view-master', $data);
    }


    public function assignAgent()
    {
        try {
            $agentName = $this->request->getPost('agent_id');
            $rowId = $this->request->getPost('row_id');

            $model = new CommonModel();
            $agent = new AgentModel();

            // Fetch the agent data based on the agent name
            $agentData = $agent->where('user_id', $agentName)->first();

            // Update the "LOS Master" row with the assigned agent name
            $model->update($rowId, ['Executive' => $agentName]);

            // The following code is for updating the 'LOS Master' as you had it

            $updateQuery = "UPDATE los_master
            JOIN agent_master ON agent_master.user_id = los_master.Executive
            SET los_master.`PayOutPercentage` =
                CASE
                    WHEN los_master.category = 'PVT' THEN agent_master.PVT
                    WHEN los_master.category = 'GOVT' THEN agent_master.GOVT
                    WHEN los_master.category = 'SEP' THEN agent_master.SEP
                    ELSE los_master.`PayOutPercentage`
                END
            WHERE los_master.category IN ('PVT', 'GOVT', 'SEP')";
            $model->query($updateQuery);

            $updateCalculations = "UPDATE los_master SET WfhDeduction = 0,
            NetPercentage = PayOutPercentage - WfhDeduction,
            GrossPayout = LoanAmount * (NetPercentage/100),
            TDS = GrossPayout * (5/100),
            NetPayment = GrossPayout - TDS";
            $model->query($updateCalculations);

            // Fetch the updated "LOS Master" row data
            $updatedRowData = $model->find($rowId);

            $response = [
                'success' => true,
                'message' => 'Agent assigned successfully.',
                'data' => $updatedRowData
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }

        return $this->response->setJSON($response);
    }

    public function getBankData()
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

    // Agent Assigning end

    public function comparedates()
    {

        $fromDate = $this->request->getPost('fromdate'); // Replace with your actual from date
        $toDate = $this->request->getPost('todate'); // Replace with your actual to date
        $bankName = $this->request->getPost('bankname');

        $this->model = new CommonModel();
        $data = $this->model->getDataBetweenDates($fromDate, $toDate, $bankName);

        // Do something with the fetched data, like passing it to the view
        // return view('your_view', ['data' => $data]);
        return json_encode($data);

    }

    public function getAgentData()
    {
        $agentName = $this->request->getPost('agentname');

        $agentModel = new AgentModel();
        $agentData = $agentModel->where('user_id', $agentName)->first();

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


    public function getdatabyid($rowId)
    {
        // Get data from the AJAX request


        $id = $this->request->getPost('rowId');

        // Perform any data processing or database queries as needed to fetch data by ID
        $this->model = new CommonModel();
        $data = $this->model->where('id', $rowId)->first();
        // $data = $this->model->getDataById($id);

        // Return the fetched data as a JSON response
        echo json_encode($data);
    }
    // ExcelController.php

    public function updateExecutive()
    {
        try {
            $id = $this->request->getVar('rowId');
            $executive = $this->request->getVar('editexecutive');

            $data['Executive'] = $executive;

            $this->model = new CommonModel();
            if ($this->model->update($id, $data)) {
                // Update was successful, fetch the updated data
                $updatedData = $this->model->where('id', $id)->first(); // Replace with your method

                // Return the updated data as JSON
                return $this->response->setJSON(['success' => true, 'data' => $updatedData]);
            } else {
                // Update failed
                // Handle the error or provide an error message
                return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update operation
            return $this->response->setJSON(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



}
