<?php

namespace App\Controllers;

use App\Models\StaffModel;
use CodeIgniter\Controller;
// use CodeIgniter\Services;

class Home extends BaseController
{
    //  protected $session;
    public function __construct()
    {
   
        helper(['url', 'form']);
        $this->staff = new StaffModel();
       
    }

    public function logout()
    {
        if (!session()->has('data')) {
            return redirect()->to(base_url());
        }

       
        session()->destroy();
        return redirect()->to(base_url(''));
    }

    
    
    public function index()
{
    $data['users'] = $this->staff->findAll();
    $validate = [];

    if ($this->request->getMethod() == 'post') {
        $rules = [
            'name'     => 'required',
            'password' => 'required',

        ];

        if ($this->validate($rules)) {
            $name = $this->request->getVar('name');
            $password = $this->request->getVar('password');
            // $role = $this->request->getVar('role');

            // Verify the provided name and password in the StaffModel
            $userdata = $this->staff->where('name',$name)->where('password', $password)->first();
            
            if ($userdata) {
                // If the user data is retrieved, set the 'data' session and redirect to the admin/home page
                session()->set('data', $userdata);
                session()->set('agent_name', $name);
                session()->set('role', $userdata['role']);
                // echo "Session data: ";
               print_r($_SESSION);
                return redirect()->to(base_url('admin/home'));
            } else {
                session()->setFlashdata('tempdata', 'Sorry! You entered an incorrect name or password');
                return redirect()->to(base_url(''));
            }
        } else {
            $validate['validation'] = $this->validator;
        }
    }

    return view('layouts/login', $validate);
}

    public function insertData($data) {
        // Fetch the logged-in user's name from session/storage
        $createdBy = $_SESSION['agent_name']; // Adjust this according to how you stored the username
    
        // Include the created by field in the data
        $data['created_by'] = $createdBy;
    
        // Insert the data into the table
        $this->db->insert('bank_master', $data);
    }
}
