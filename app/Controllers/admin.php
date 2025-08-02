<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AgentModel;
use App\Models\StaffModel;
use App\Models\NumberofScheme;
use App\Models\SubAgentModel;
use COdeigniter\Controller;
use DateTime;


class admin extends BaseController
{
    public function __construct()
    {

        helper(['url', 'form']);
        $this->model = new UserModel();
    }

    public function home()
    {
        $model = new UserModel();
        $agent = new AgentModel();
        $staff = new StaffModel();
        $subagent = new SubAgentModel();
        $data['countOfStaff'] = $staff->getCountOfStaff();
        $data['countOfAgent'] = $agent->getCountOfAgents();
        $data['countOfBanks'] = $model->getCountOfBanks();
        $data['countOfsubAgent'] = $subagent->getCountOfsubAgent();

        // return view('your_view_file', $data);


        $data['pageTitle'] = 'Dashboard';
        return view('pages/index', $data);
    }
    public function bank()
    {

        $data['pageTitle'] = 'Bank';
        return view('pages/bank', $data);
    }

    public function datatable()
    {
        return view('pages/datatable');
    }


    public function agent()
    {
        $data['pageTitle'] = 'Agent Details';
        return view('pages/agent', $data);
    }
    public function staff()
    {
        $data['pageTitle'] = 'Staff Details';
        return view('pages/staff', $data);
    }
    public function uploadmaster()
    {
        $data['pageTitle'] = 'Upload Master Sheet';
        return view('pages/upload-master-sheet', $data);
    }
    public function viewmaster()
    {
        $data['pageTitle'] = 'View Master Sheet';
        return view('pages/view-master', $data);
    }
    public function assignagents()
    {
        $data['pageTitle'] = 'Assign Agents';
        return view('pages/assign-agents', $data);
    }
    public function subagents()
    {
        $data['pageTitle'] = 'Manage Sub Agents';
        return view('pages/manage-subagents', $data);
    }
    public function mis()
    {
        $data['pageTitle'] = 'MIS Calculations';
        return view('pages/mis-calculations', $data);
    }
    public function gipv()
    {
        $data['pageTitle'] = 'Generate Invoice & Payment voucher';
        return view('pages/generate-i-pv', $data);
    }
    public function empty()
    {
        $data['pageTitle'] = 'Empty';
        return view('pages/empty', $data);
    }
    public function agentlist()
    {
        $data['pageTitle'] = 'Agent List';
        return view('pages/agent-list', $data);
    }
    public function agentinvoicereport()
    {
        $data['pageTitle'] = 'Agent Invoice Report';
        return view('pages/agent-invoice-report', $data);
    }
    public function Agentmasterreport()
    {
        $data['pageTitle'] = 'Agent Master Report';
        return view('pages/agent-report', $data);
    }
    public function bankmasterreport()
    {
        $data['pageTitle'] = 'Bank Master Report';
        return view('pages/bank-report', $data);
    }
    public function lossearch()
    {
        $data['pageTitle'] = 'LOS Search';
        return view('pages/LOS-search', $data);
    }
    public function customersearch()
    {
        $data['pageTitle'] = 'Customer Search';
        return view('pages/c-name-search', $data);
    }
    public function bankbranch()
    {
        $data['pageTitle'] = 'Bank Branch Search';
        return view('pages/b-b-search', $data);
    }
    public function gstreport()
    {
        $data['pageTitle'] = 'GST Report';
        return view('pages/gst-report', $data);
    }

    public function bank_details()
    {

        $data['users'] = $this->model->where('status', 1)->get()->getResultArray();
        return view('pages/bank', $data);
    }
    public function savedata()
    {
        $name = $this->request->getVar('name');
        $branch = $this->request->getVar('branch');

        // Check if a bank with the same name and branch already exists
        $existingBank = $this->model->where('name', $name)->where('branch', $branch)->where('status', 1)->first();

        if ($existingBank) {
            // Bank with the same name and branch already exists, show error
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'This bank already exists with the same branch.');
            return $this->response->redirect(base_url('admin/bank'));
        }

        // If no existing bank found, proceed with inserting new bank data
        $datas = [
            'name' => $name,
            'branch' => $branch,
            'from_date' => $this->request->getVar('from_date'),
            // Other fields...
        ];
        $fromDateObj = new DateTime($datas['from_date']);
        $toDateObj = clone $fromDateObj;
        $toDateObj->modify('-1 day');
        $toDateObj->modify('+1 month');
        $datas['from_date'] = $fromDateObj->format('Y-m-d');
        $datas['to_date'] = $toDateObj->format('Y-m-d');
        // Insert the new bank data
        $this->model->insert($datas);
        // Retrieve the inserted bank ID
        $bankId = $this->model->insertID();

        // Insert scheme data if provided
        if ($this->request->getPost('schemano') && $this->request->getPost('schemano') > 0) {
            $schemeCount = intval($this->request->getPost('schemano'));
            $createdBy = $_SESSION['agent_name'];
            $schemeData = [];

            for ($i = 0; $i < $schemeCount; $i++) {
                $schemeData[] = [
                    'bank_id' => $bankId,
                    'scheme_name' => $this->request->getPost('schemaName[]')[$i],
                    'created_by' => $createdBy
                ];
            }

            $NumberofSchemeModel = new NumberofScheme();

            if ($NumberofSchemeModel) {
                $this->session->setFlashdata('status', 'success');
                $this->session->setFlashdata('message', 'Bank Data Inserted Successfully.');
            } else {
                $this->session->setFlashdata('status', 'error');
                $this->session->setFlashdata('message', 'Something Wrong.');
            }

            $NumberofSchemeModel->insertBatch($schemeData);
        } else {
            // Insert null values for 'scheme_name' when no schemes are provided
            $NumberofSchemeModel = new NumberofScheme();
            $NumberofSchemeModel->insert(['bank_id' => $bankId, 'scheme_name' => null]);

            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Bank Data Inserted successfully ');
        }

        return $this->response->redirect(base_url('admin/bank'));
    }


    public function view($id)
    {
        // Load your model for bank data (replace 'BankModel' with your actual model)
        $model = new UserModel();

        // Fetch bank details by ID from your model
        $bankData = $model->find($id);

        // Fetch scheme names associated with the bank
        $schemesModel = new NumberofScheme();
        $schemeData = $schemesModel->where('bank_id', $id)->findAll();

        // Combine bank data and scheme data
        $data = [
            'bank_id' => $bankData,
            'scheme_name' => $schemeData,
        ];

        // Return data as JSON
        return $this->response->setJSON($data);
    }


    public function edit($id)
    {
        $data = $this->model->where('id', $id)->first();
        echo json_encode($data);
    }
    public function update()
    {
        $id = $this->request->getVar('edit_id');
        $name = $this->request->getVar('name');
        $branch = $this->request->getVar('branch');
        $address = $this->request->getVar('address');
        $modifyBy = $_SESSION['agent_name'];
        $data['name'] = $name;
        $data['branch'] = $branch;
        $data['address'] = $address;
        $data['modify_by'] = $modifyBy;

        $update = $this->model->update($id, $data);
        if ($update) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Bank Data Updated Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }
        return $this->response->redirect(base_url('admin/bank'));
    }
    public function delete($id)
    {
        $model = new UserModel();

        $existingRecord = $this->model->find($id);

        if (!$existingRecord) {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Record not found.');
            return $this->response->redirect(base_url('admin/bank'));
        }

        $data = $this->model->update($id, ['status' => 0]);

        if ($data) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Bank Data Deleted Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }
        return $this->response->redirect(base_url('admin/bank'));
        echo json_encode($data);

    }

    public function uploadmastersheet()
    {
        $data['banks'] = $this->model->select('name')->distinct()->findAll();
        return view('pages/upload-master-sheet', $data);
    }


}
