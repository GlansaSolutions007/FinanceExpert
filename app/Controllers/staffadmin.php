<?php

namespace App\Controllers;
use App\Models\StaffModel;
use COdeigniter\Controller;

class staffadmin extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
        $this->staff = new StaffModel();
    }

    public function home()
    {
        $data['pageTitle'] = 'Dashboard';
        return view('pages/index', $data);
    }
    public function staff()
    {
        $data['pageTitle'] = 'Staff Details';
        return view('pages/staff', $data);
    }
    public function agent()
    {
        $data['pageTitle'] = 'Agent Details';
        return view('pages/agent', $data);
    }
    public function display()
    {
        // $agent = new AgentModel();
        $data['user'] = $this->staff->where('status', 1)->get()->getResultArray();

        return view('pages/staff', $data);
    }

    public function insert()
    {
        $id = $this->request->getVar('id');
        $createdBy = $_SESSION['agent_name'];

        // Retrieve form data
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $is_admin = $this->request->getPost('is_admin');

        // Check if the staff data already exists
        $isExisting = $this->staff->isStaffExist($name, $password, $is_admin);
        if ($isExisting) {
            // If data already exists, show SweetAlert message and return
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'staff already exists.');
            return $this->response->redirect(base_url('staffadmin/display'));
        }

        // Prepare data for insertion
        $data = [
            'name' => $name,
            'email' => $email,
            'created_by' => $createdBy,
            'password' => $password,
            'role' => ($is_admin === '1') ? '1' : '2'
        ];

        // Insert data into the database
        $insert = $this->staff->insert($data);

        // Set flash message based on insertion result
        if ($insert) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Staff Inserted successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something went wrong while inserting data.');
        }

        // Redirect to the appropriate page
        return $this->response->redirect(base_url('staffadmin/display'));
    }


    public function edit($id)
    {
        $data = $this->staff->where('id', $id)->first();
        echo json_encode($data);
    }


    public function update()
    {
        $id = $this->request->getVar('edit_id');
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $is_admin = $this->request->getVar('is_admin1');
        $password = $this->request->getVar('password');
        $modifyBy = $_SESSION['agent_name'];
        $data['name'] = $name;
        $data['email'] = $email;
        $data['role'] = $is_admin;
        $data['password'] = $password;
        $data['modify_by'] = $modifyBy;

        $update = $this->staff->update($id, $data);

        if ($update) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Staff Updated Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }
        return $this->response->redirect(base_url('staffadmin/display'));
    }

    public function delete($id)
    {
        // Check if the record exists
        $existingRecord = $this->staff->find($id);

        if (!$existingRecord) {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Record not found.');
            return $this->response->redirect(base_url('staffadmin/display'));
        }

        // Update the status to 0
        $data = $this->staff->update($id, ['status' => 0]); // Assuming 'status' is the field to update

        if ($data) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Staff Deactivated Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Went Wrong.');
        }

        return $this->response->redirect(base_url('staffadmin/display'));
    }
}
?>