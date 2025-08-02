<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AgentModel;
use App\Models\StaffModel;
use App\Models\Paymentmodel;
use App\Models\EmiRecoveryModel;
use App\Models\EmiModel;
use App\Models\NumberofScheme;
use COdeigniter\Controller;
use DateTime;


class paymentcontroller extends BaseController
{
    public function __construct()
    {

        helper(['url', 'form']);
        // $this->payment = new Paymentmodel();
    }
    public function issueCapital()
    {
        $agentModel = new AgentModel();
        $this->emiModel = new EmiModel();

        $data['loans'] = $this->emiModel->where('status', 1)->get()->getResultArray();
        $data['agents'] = $agentModel->findAll();
        return view('pages/issueCapital', $data);
    }

    public function getAgentData()
    {
        $agentId = $this->request->getVar('agentId');
        $model = new AgentModel();
        $data = $model->where('user_id', $agentId)->first();

        // Set the content type to JSON
        $this->response->setHeader('Content-Type', 'application/json');

        // Return the JSON-encoded data
        return json_encode($data);
    }
    public function getAgentName($agentID)
    {
        $agentModel = new AgentModel();
        // $agent = $agentModel->find($agentID);
        $agent = $agentModel->where('user_id', $agentID)->first();

        if ($agent) {
            $agentName = $agent['name'];
            $agentgst = $agent['gst_no'];
        } else {
            $agentName = 'Agent not found';
        }

        // Return the agent name as a JSON response
        return $this->response->setJSON($agent);
    }
    public function editLoan($id)
    {

        $this->model = new EmiModel();
        $data = $this->model->where('id', $id)->first();
        echo json_encode($data);

    }
    public function loanupdate()
    {
        $id = $this->request->getPost('edit_id');
        $agentName = $this->request->getPost('agentName');
        $loanAmount = $this->request->getPost('loan');
        $date = $this->request->getPost('date');
        $duration = $this->request->getPost('duration');
        $emi = $this->request->getPost('emi');
        $modifyBy = $_SESSION['agent_name'];
        $data['agentName'] = $agentName;
        $data['loanAmount'] = $loanAmount;
        $data['date'] = $date;
        $data['monthlyEmi'] = $emi;
        $data['month'] = $duration;
        $data['modify_by'] = $modifyBy;

        $this->model = new EmiModel();
        $update = $this->model->update($id, $data);
        if ($update) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Payment Data Updated successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }
        return $this->response->redirect(base_url('paymentcontroller/issueCapital'));
    }


    public function delete($id)
    {
        $this->model = new EmiModel();

        $existingRecord = $this->model->find($id);

        if (!$existingRecord) {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Record not found.');
            return $this->response->redirect(base_url('paymentcontroller/issueCapital'));
        }

        $data = $this->model->update($id, ['status' => 0]);

        //   $data = $this->model->where('id', $id)->delete($id);
        if ($data) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Loan Data Deleted Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }
        return $this->response->redirect(base_url('paymentcontroller/issueCapital'));
        echo json_encode($data);

    }
    public function getpayableAmount()
    {
        $userId = $this->request->getVar('userId');
        $fromdate = $this->request->getVar('fromdate');
        $todate = $this->request->getVar('todate');

        $db = db_connect();

        $query = $db->table('payment')
            ->select('payableAmount')
            ->where('agent_id', $userId)
            ->where('transaction_date >=', $fromdate)
            ->where('transaction_date <=', $todate)
            ->get();

        $results = $query->getResult();

        return $this->response->setJSON($results);
    }


    public function insertLoan()
    {
        if ($this->request->getMethod() === 'post') {
            // Process form submission
            $agentID = $this->request->getPost('agent_id');
            $agentName = $this->request->getPost('agent_name');
            $loanAmount = $this->request->getPost('loanAmount');
            $month = $this->request->getPost('month');
            $monthlyemi = $this->request->getPost('monthlyemi');
            $loandate = $this->request->getPost('from_date');
            $remarks = $this->request->getPost('remarks');
            $randomNumber = mt_rand(10000, 99999);

            // Generate the random voucher code
            $randomVoucherCode = 'FIN' . $randomNumber;
            $createdBy = $_SESSION['agent_name'];

            // Check if there is an existing entry in emiRecovery
            $emiRecoveryModel = new EmiRecoveryModel();
            $existingEntry = $emiRecoveryModel->where('agent_id', $agentID)->orderBy('date', 'desc')->first();

            // Initialize variables for updated values
            $updatedLoanAmount = $loanAmount;
            $updatedMonth = $month;
            $updatedMonthlyEmi = $monthlyemi;

            if ($existingEntry) {
                // Retrieve the previous remaining debt amount and month
                $previousRemainingDebt = $existingEntry['remainingDebtAmount'] ?? 0;
                $previousMonth = $existingEntry['month'] ?? 0;
                $previousMonthlyEmi = $existingEntry['monthlyEmi'] ?? 0;

                // Calculate the updated loan amount, month, and monthlyEmi
                $updatedLoanAmount = $previousRemainingDebt + $loanAmount;
                $updatedMonth = $previousMonth + $month;
                $updatedMonthlyEmi = $previousMonthlyEmi + $monthlyemi;
            }

            // Create data for emiRecovery
            $emiRecoveryData = [
                'agent_id' => $agentID,
                'agentName' => $agentName,
                'loanAmount' => $updatedLoanAmount,
                'remainingDebtAmount' => $updatedLoanAmount,
                'month' => $updatedMonth,
                'monthlyEmi' => $updatedMonthlyEmi,
                'date' => $loandate,
                'remarks' => $remarks,
                'voucher' => $randomVoucherCode,
                'created_by' => $createdBy,
            ];

            // Create data for emi
            $emiData = [
                'agent_id' => $agentID,
                'agentName' => $agentName,
                'loanAmount' => $loanAmount,
                'remainingDebtAmount' => $loanAmount,
                'month' => $month,
                'monthlyEmi' => $monthlyemi,
                'date' => $loandate,
                'remarks' => $remarks,
                'voucher' => $randomVoucherCode,
                'created_by' => $createdBy,
            ];

            // Load the model and insert the data into the database for both tables
            $emiModel = new EmiModel();
            $emiRecoveryModel = new EmiRecoveryModel(); // Fix variable name
            $emiModel->insert($emiData);
            $emiRecoveryModel->insert($emiRecoveryData); // Fix variable name

            return $this->response->setJSON([
                'voucher' => $randomVoucherCode,
                'agentName' => $agentName,
                'loanAmount' => $loanAmount,
                'date' => $loandate,
                // Add more receipt details here as needed
            ]);

            // Redirect to the payment details page and pass the data to be displayed
            return redirect()->to(base_url('paymentcontroller/issueCapital'))->with('payment_data', $emiData);
        } else {
            // If the form is not submitted, load the view with agent data for the dropdown
            $agentModel = new AgentModel();
            $data['agent_id'] = $agentModel->findAll();
            return view('pages/issueCapital', $data);
        }
    }
    public function getData()
    {
        $agentId = $this->request->getVar('agentId');
        $fromdate = $this->request->getVar('fromdate');
        $todate = $this->request->getVar('todate');
        $paymentFor = $this->request->getVar('paymentFor');

        // Load the database library
        $db = \Config\Database::connect();



        if ($paymentFor == ['mis']) {
            $emiQuery = $db->table('emi_recovery')
                ->select('monthlyEmi')
                ->select('remainingDebtAmount')
                ->select('id')
                ->where('agent_id', $agentId)
                // ->where('remainingDebtAmount', '!=', 0)
                ->orderBy('date', 'DESC')
                ->limit(1)
                ->get();
            // ->first();


            // Fetch data from 'loan' table
            $loanQuery = $db->table('los_master')
                ->selectSum('GrossPayout') // Assuming loanAmount exists in the 'loan' table
                ->select('id')
                ->where('Executive', $agentId)
                ->where('DisbursalDate >=', $fromdate)
                ->where('DisbursalDate <=', $todate)
                ->get();

            $onSpotQuery = $db->table('payment')
                ->selectSum('payment_amount')
                ->where('agent_id', $agentId)
                ->where('payment_for', 'onspot')
                ->where('transaction_date >=', $fromdate)
                ->where('transaction_date <=', $todate)
                ->get();

            // Combine the results from both queries
            $combinedResults = array_merge($emiQuery->getResultArray(), $loanQuery->getResultArray(), $onSpotQuery->getResultArray());

            return $this->response->setJSON([
                'combinedData' => $combinedResults,
            ]);
        }
    }
    public function payment_display()
    {
        $data['pageTitle'] = 'Payment';
        $agentModel = new AgentModel();
        $this->payment = new Paymentmodel();
        $data['agent_id'] = $agentModel->findAll();
        $data['payment'] = $this->payment->where('status', 1)->get()->getResultArray();
        return view('pages/agent_payment', $data);
        // return view('pages/agent_payment',$data);
    }

    public function edit($id)
    {
        $this->payment = new Paymentmodel();
        $data = $this->payment->where('id', $id)->first();
        echo json_encode($data);

    }

    public function update()
    {
        $id = $this->request->getVar('edit_id');
        $name = $this->request->getVar('editname'); // Use the correct input field name
        $gst_no = $this->request->getVar('editgst_no');
        $transaction_date = $this->request->getVar('edittransaction_date');
        $transaction_type = $this->request->getVar('edittransaction_type');
        $transaction_id = $this->request->getVar('edittransaction_id');
        $payableAmount = $this->request->getVar('editpayableAmount'); // Correct input field name
        $payment_for = $this->request->getVar('editpayment_for');
        $remark = $this->request->getVar('editremark');
        $modifyBy = $_SESSION['agent_name'];

        $data = [
            'agent_name' => $name,
            'gst_no' => $gst_no,
            'transaction_date' => $transaction_date,
            'transaction_type' => $transaction_type,
            'transaction_id' => $transaction_id,
            'payableAmount' => $payableAmount,
            'payment_for' => $payment_for,
            'remark' => $remark,
            'modify_by' => $modifyBy,
        ];

        $this->payment = new Paymentmodel();
        $update = $this->payment->update($id, $data);

        if ($update) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Paymen Data Updated successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something went wrong.');
        }

        return redirect()->to(base_url('paymentcontroller/payment_display'));
    }

    public function deletepayment($id)
    {
        $this->payment = new Paymentmodel();

        // Check if the record exists
        $existingRecord = $this->payment->find($id);

        if (!$existingRecord) {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Record not found.');
            return $this->response->redirect(base_url('paymentcontroller/payment_display'));
        }

        // Update the status to 0
        try {
            $data = $this->payment->update($id, ['status' => 0]);

            if ($data) {
                $this->session->setFlashdata('status', 'success');
                $this->session->setFlashdata('message', 'Payment Data Deleted Successfully.');
            } else {
                $this->session->setFlashdata('status', 'error');
                $this->session->setFlashdata('message', 'Failed to update the payment data.');
            }
        } catch (\Exception $e) {
            // Handle the exception, log the error, or display an error message
            log_message('error', 'Error updating payment data: ' . $e->getMessage());
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something went wrong.');
        }

        return $this->response->redirect(base_url('paymentcontroller/payment_display'));
    }
    public function insertEmi()
    {
        if ($this->request->getMethod() === 'post') {
            // Process form submission
            $agentID = $this->request->getPost('agent_id');
            $agentName = $this->request->getPost('agent_name');
            $fromdate = $this->request->getVar('fromdate');
            $todate = $this->request->getVar('todate');
            $paymentDate = $this->request->getPost('date');
            $payment_for = $this->request->getPost('payment_for');
            $transactiontype = $this->request->getPost('transaction_type');
            $transactionID = $this->request->getPost('transaction_id');
            $gst_no = $this->request->getPost('gst_no');
            $remark = $this->request->getPost('remark');
            $paymentDate = $this->request->getPost('date');
            $paymentAmount = $this->request->getPost('payment_amount');
            $emiAmount = $this->request->getPost('emiAmount');
            $randomNumber = mt_rand(10000, 99999);
            $payEmi = $this->request->getPost('payEmi');
            $this->db = \Config\Database::connect();
            // Generate the random voucher code
            $randomVoucherCode = 'FIN' . $randomNumber;

            // Retrieve the previous loan data
            $paymentModel = new Paymentmodel();
            $existingRecord = $this->db->table('payment')
                ->where('agent_id', $agentID)
                ->where('transaction_date >=', $fromdate)
                ->where('transaction_date <=', $todate)
                ->get()
                ->getRow();

            if ($existingRecord) {
                // Update the existing record
                $dataToUpdate = [
                    'payableAmount' => $paymentAmount,
                ];

                $this->db->table('payment')
                    ->where('agent_id', $agentID)
                    ->where('transaction_date >=', $fromdate)
                    ->where('transaction_date <=', $todate)
                    ->update($dataToUpdate);
            } else {
                // Insert a new record
                $dataToInsert = [
                    'agent_id' => $agentID,
                    'agent_name' => $agentName,
                    'gst_no' => $gst_no,
                    'transaction_id' => $transactionID,
                    'transaction_type' => $transactiontype,
                    'remark' => $remark,
                    'payment_amount' => $paymentAmount,
                    'voucher' => $randomVoucherCode,
                    'payment_for' => $payment_for,
                    'transaction_date' => $paymentDate,
                    'payableAmount' => $paymentAmount,

                ];

                $this->db->table('payment')->insert($dataToInsert);
            }
            $emiRecoveryModel = new EmiRecoveryModel();
            $previousLoanData = $emiRecoveryModel->where('agent_id', $agentID)
                ->orderBy('date', 'DESC')
                ->first();

            // Check if previous loan data is present
            if ($this->request->getMethod() === 'post') {
                $agentID = $this->request->getPost('agent_id');
                $agentName = $this->request->getPost('agent_name');
                $paymentDate = $this->request->getPost('date');
                $remark = $this->request->getPost('remark');
                $paymentAmount = $this->request->getPost('payment_amount');
                $randomNumber = mt_rand(10000, 99999);
                $payEmi = $this->request->getPost('payEmi');

                if ($payEmi == 'on') {
                    // Checkbox is checked, return JSON response
                    return $this->response->setJSON([
                        'voucher' => $randomNumber,
                        'agent_name' => $agentName,
                        'payment_amount' => $paymentAmount,
                        'date' => $paymentDate
                        // Add more receipt details here as needed
                    ]);
                } else {
                    // Checkbox is not checked, proceed with updating loan data and inserting payment record
                    $emiAmount = $this->request->getPost('emiAmount');
                    $emiRecoveryModel = new EmiRecoveryModel();
                    $previousLoanData = $emiRecoveryModel->where('agent_id', $agentID)
                        ->orderBy('date', 'DESC')
                        ->first();

                    if ($previousLoanData) {
                        // Calculate updated values
                        $previousLoanAmount = $previousLoanData['loanAmount'];
                        $previousRemainingDebt = $previousLoanData['remainingDebtAmount'];
                        $previousMonth = $previousLoanData['month'];
                        $loanDate = $previousLoanData['date'];

                        // Calculate the new values
                        $newLoanAmount = $previousLoanAmount - $emiAmount;
                        $newRemainingDebt = $previousRemainingDebt - $emiAmount;
                        $newMonth = $previousMonth - 1;

                        // Insert the new payment record with updated values
                        if ($newRemainingDebt >= 0 && $loanDate != $paymentDate) {
                            $data = [
                                'agent_id' => $agentID,
                                'agentName' => $agentName,
                                'date' => $paymentDate,
                                'remarks' => $remark,
                                'loanAmount' => $previousLoanAmount,
                                'monthlyEmi' => $emiAmount,
                                'voucher' => $randomNumber,
                                'remainingDebtAmount' => $newRemainingDebt,
                                'month' => $newMonth,
                            ];

                            $emiRecoveryModel->insert($data);
                        }
                    }

                    // Redirect to the payment details page and pass the data to be displayed
                    return redirect()->to(base_url('paymentcontroller/payment_display'))->with('payment_data', $data);
                }
            }

        } else {
            return $this->response->setJSON([
                'voucher' => $randomVoucherCode,
                'agent_name' => $agentName,
                'payment_amount' => $paymentAmount,
                'date' => $paymentDate
                // Add more receipt details here as needed
            ]);
            // Redirect to the payment details page and pass the data to be displayed
            return redirect()->to(base_url('paymentcontroller/payment_display'))->with('payment_data', $data);
        }

        return $this->response->setJSON([
            'voucher' => $randomVoucherCode,
            'agent_name' => $agentName,
            'payment_amount' => $paymentAmount,
            'date' => $paymentDate
            // Add more receipt details here as needed
        ]);
        // Redirect to the payment details page and pass the data to be displayed
        return redirect()->to(base_url('paymentcontroller/payment_display'))->with('payment_data', $data);

    }
    public function insertPayment()
    {
        $paymentModel = new PaymentModel();
        //  $createdBy = $_SESSION['agent_name'];

        if ($this->request->getMethod() === 'post') {
            // Process form submission
            $agentID = $this->request->getPost('agent_id');
            $agentName = $this->request->getPost('agent_name');
            $gst_no = $this->request->getPost('gst_no');
            $payment_for = $this->request->getPost('payment_for');
            $transactionID = $this->request->getPost('transaction_id');
            $transactiontype = $this->request->getPost('transaction_type');
            $paymentDate = $this->request->getPost('date');
            $remark = $this->request->getPost('remark');
            $paymentAmount = $this->request->getPost('payment_amount');
            $randomNumber = mt_rand(10000, 99999);

            // Generate the random voucher code
            $randomVoucherCode = 'FIN' . $randomNumber;
            $existingData = $paymentModel->where('agent_id', $agentID)
                ->where('transaction_date', $paymentDate)
                ->where('transaction_id', $transactionID)
                ->first();

            if (!$existingData) {
                // Data does not exist, insert new data into the database
                if ($transactiontype === 'Other') {
                    $otherTransactionDetails = $this->request->getPost('other_transaction_details');
                    $transactiontype = 'Other: ' . $otherTransactionDetails;
                }

                // Create an array with the data to be inserted into the database
                $data = [
                    'agent_id' => $agentID,
                    'agent_name' => $agentName,
                    'gst_no' => $gst_no,
                    'transaction_id' => $transactionID,
                    'payment_for' => $payment_for,
                    'transaction_date' => $paymentDate,
                    'transaction_type' => $transactiontype,
                    'remark' => $remark,
                    'payment_amount' => $paymentAmount,
                    'voucher' => $randomVoucherCode,
                    // 'created_by' => $createdBy, 
                ];

                // Insert the data into the database
                $paymentModel->insert($data);

            } else {
                // Data already exists, handle the situation as needed
                // For example, you might want to update the existing data or return an error message.
            }


            return $this->response->setJSON([
                'voucher' => $randomVoucherCode,
                'agent_name' => $agentName,
                'payment_amount' => $paymentAmount,
                'date' => $paymentDate
                // Add more receipt details here as needed
            ]);

            // Redirect to the payment details page and pass the data to be displayed
            return redirect()->to(base_url('paymentcontroller/payment_display'))->with('payment_data', $data);
        } else {
            // If the form is not submitted, load the view with agent data for the dropdown
            $agentModel = new AgentModel();
            $data['agent_id'] = $agentModel->findAll();
            return view('pages/agent_payment', $data);
        }
    }

}