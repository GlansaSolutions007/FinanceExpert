<?php
    namespace App\Controllers;
    use App\Models\AgentModel;
    use App\Models\SubAgentModel;
    use App\Models\CommonModel;
    use CodeIgniter\Controller;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Exception;

    class agentadmin extends BaseController
    {
        public  function __construct()
        {
            helper(['url','form']);
            $this->agent = new AgentModel();
            $this->subAgentModel =  new SubAgentModel();
        }
        
    public function home()
    {   
        $data['pageTitle']='Dashboard';
        return view('pages/index',$data);
    }
    
    public function agent()
    {   
        $data['pageTitle']='Agent Details';
        return view('pages/agent',$data);
    }
    
    public function checkEmail()
    {
        $this->agent = new AgentModel();
        $email = $this->request->getVar('email'); // Assuming you send the email through POST

        $result = $this->agent->checkEmailExistence($email);

        // Return a JSON response
        return $this->response->setJSON(['exists' => $result]);
    }

    // App/Controllers/agentadmin.php
    
    public function exportToExcel()
    {
        try {
            // Load your model (replace 'YourModel' with your actual model)
            $model = new AgentModel();
    
            // Retrieve the data you want to export from the model
            $data = $model->getDataToExport(); // Replace with the actual method to get your data
    
            // Check if there is data to export
            if (!empty($data)) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet(0);
    
                // Define your headers here
                $headers = ['S.No', 'Name', 'Mobile No', 'Email', 'Address', 'Adhar No', 'Pan No'];
    
                // Add headers to the spreadsheet
                $sheet->fromArray([$headers], null, 'A1');
    
                // Loop through your data and add it to the spreadsheet
                foreach ($data as $index => $row) {
                    $rowData = [
                        $index + 1,
                        $row['name'],
                        $row['phone_no'],
                        $row['email'],
                        $row['address'],
                        $row['adhar_no'],
                        // $row['adhar_files'],
                        $row['pan_no'],
                        // $row['pan_files'],
                        // Add the action data here
                    ];
    
                    // Add data to the spreadsheet starting from row 2
                    $sheet->fromArray([$rowData], null, 'A' . ($index + 2));
                }
    
                // Create the Excel file
                $writer = new Xlsx($spreadsheet);
    
                // Set the response headers to trigger a download
                $filename = 'AgentList' . date('Y-m-d_H:i:s') . '.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $filename . '"');
                header('Cache-Control: max-age=0');
                
                // Write the Excel file directly to the output buffer
                $writer->save('php://output');
                exit();
            } else {
                return $this->response->setJSON(['error' => 'No data found between the selected dates.']);
            }
        } catch (Exception $e) {
            // Handle or log the exception here
            return $this->response->setJSON(['error' => $e->getMessage()]);
        }
    }
    
public function display()
{
    $agentModel = new AgentModel();
    $agents = $agentModel->where('status', 1)->findAll(); // Add the status condition

    $data['agents'] = [];
    foreach ($agents as $agentData) {
        $agentId = $agentData['id'];
        $subAgentModel = new SubAgentModel();

        // Fetch subagents count for the agent with status = 1
        $subAgentCount = $subAgentModel->where(['agent_id' => $agentId, 'status' => 1])->countAllResults();

        // Combine agent data with sub_agent_count
        $agentData['sub_agent_count'] = $subAgentCount;

        // Fetch subagents data for the agent with status = 1
        $subAgents = $subAgentModel->where(['agent_id' => $agentId, 'status' => 1])->findAll();

        // Add subagents data to the agent data
        $agentData['sub_agents'] = $subAgents;

        // Add the modified agent data to the data array
        $data['agents'][] = $agentData;
    }

    return view('pages/agent', $data);
}


public function insertsubagent()
{
    $createdBy = $_SESSION['agent_name']; 
    $subAgentData = [
        'name' => $this->request->getPost('SubagentName'),
        'phone_no' => $this->request->getPost('SubagentPhone'),
        'email' => $this->request->getPost('SubagentEmail'),
        'address' => $this->request->getPost('SubagentAddress'),
        'gst_no' => $this->request->getPost('SubagentGstNumber'),
        'adhar_no' => $this->request->getPost('SubagentadharNumber'),
        'adhar_image' => $this->request->getPost('subadhar_files'),
        'pan_no' => $this->request->getPost('SubagentpanNumber'),
        'pan_image' => $this->request->getPost('subpan_files'),
        'agent_id' => $this->request->getPost('agent_id'),
        'created_by' => $createdBy,
       
    ];
    
    
    $subagentInsrted=$this->subAgentModel->insert($subAgentData);
    
     if ($subagentInsrted) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'SubAgent Inserted Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }

    
    return redirect()->to(base_url('agentadmin/display'));
}

  public function insert()
{
    $agentName = $this->request->getPost('user_id');
    $createdBy = $_SESSION['agent_name'];
    $count = $this->agent->getCountOfAgents();
    
    if ($count && isset($count['lastAgent']) && isset($count['lastAgent']['user_id'])) {
        $agentName = $count['lastAgent']['user_id'];
        $matches = [];
        
        // Use a regular expression to match the numeric part
        preg_match('/(\d+)$/', $agentName, $matches);
        
        // Check if there is a match and retrieve the numeric part
        if (!empty($matches)) {
            $numericPart = $matches[1];
            $nextAgentNo = $numericPart + 1;
        } else {
            echo "No numeric part found.";
            return; // Abort further processing if no numeric part is found
        }
    } else {
        // If count is 0, start the agent from 1
        $nextAgentNo = 1;
    }
        $prefix = "FIN23A";
    
        $agentData = [
            'user_id' => $prefix . $nextAgentNo,
            'name' => $this->request->getPost('name'),
            'phone_no' => $this->request->getPost('phone_no'),
            'email' => $this->request->getPost('aemail'),
            'address' => $this->request->getPost('address'),
            'account_no' => $this->request->getPost('account_no'),
            'PVT' => $this->request->getPost('private'),
            'GOVT' => $this->request->getPost('goverment'),
            'SEP' => $this->request->getPost('files'),
            'adhar_no' => $this->request->getPost('adhar_no'),
            'pan_no' => $this->request->getPost('pan_no'),
            'gst_no' => $this->request->getPost('gst_no'),
            'created_by' => $createdBy,
        ];
            
       
        // Get the Aadhar file
        $aadharFile = $this->request->getFile('adhar_files');
        if ($aadharFile && $aadharFile->isValid() && !$aadharFile->hasMoved()) {
            $aadharFileName = $aadharFile->getRandomName();
            $aadharFile->move(ROOTPATH . 'writable/uploads/Aadhar_images/', $aadharFileName);
            $agentData['adhar_files'] = $aadharFileName;
        }
        
        // Get the Pan file
        $panFile = $this->request->getFile('pan_files');
        if ($panFile && $panFile->isValid() && !$panFile->hasMoved()) {   
            $panFileName = $panFile->getRandomName();
            $panFile->move(ROOTPATH . 'writable/uploads/Pan_images/', $panFileName);
            $agentData['pan_files'] = $panFileName;
        }

           
        $this->agent->insert($agentData);
        $agentId = $this->agent->insertID();
        
         if ($agentId) {
            $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Agent Inserted Successfully.');
        } else {
            $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }

         
        if ($this->request->getPost('subno') && $this->request->getPost('subno') > 0) {
            $subAgentCount = intval($this->request->getPost('subno'));
            $subAgentData = [];
            for ($i = 0; $i < $subAgentCount; $i++) {
                $subAgentData[] = [
                    'agent_id' => $agentId,
                    'name' => $this->request->getPost('subAgentName')[$i],
                    'phone_no' => $this->request->getPost('mobileNumber')[$i],
                    'email' => $this->request->getPost('email')[$i],
                    'address' => $this->request->getPost('subagent_address')[$i],
                    'adhar_no' => $this->request->getPost('subaadhar_no')[$i],
                    'pan_no' => $this->request->getPost('subpan_no')[$i],
                    'gst_no' => $this->request->getPost('gst_number')[$i],
                ];
                
            }
            
            $subAgentModel = new SubAgentModel();
            $subAgentModel->insertBatch($subAgentData);
        }
    
        return redirect()->to(base_url('agentadmin/display'));
      }


     public function getSubAgents()
{
    $id = $this->request->getVar('agent_id');

    // Assuming 'status' is the field you want to check
    $subagents = $this->subAgentModel->where(['agent_id' => $id, 'status' => 1])->get()->getResultArray();

    $subagentCount = count($subagents);

    echo json_encode(['subagent_count' => $subagentCount, 'subagents' => $subagents]);
}


   // Fetch Subagent Functionality
     public function edit($id){
        $data = $this->agent->where('id', $id)->first();
        echo json_encode($data);
        
    }
     
    
    // Update Subagent Functionality
   public function updatesubagent(){
     
       
        $id = $this->request->getVar('subagent_id');
           $name = $this->request->getVar('editSubagentName');
           $mobile  = $this->request->getVar('editSubagentPhone');
           $email  = $this->request->getVar('editSubagentEmail');
           $address  = $this->request->getVar('editSubagentAddress');
           
           
       $data['name']=$name;
       $data['phone_no']=$mobile;
       $data['email']=$email;
       $data['address']=$address;


       $updatesubagent=$this->subAgentModel->update($id, $data); 
       if ($updatesubagent) {
        $this->session->setFlashdata('status', 'success');
        $this->session->setFlashdata('message', 'SubAgent Updated Successfully.');
    } else {
        $this->session->setFlashdata('status', 'error');
        $this->session->setFlashdata('message', 'Something Wrong.');
    }
       return $this->response->redirect(base_url('agentadmin/display'));
   }

    // Update Agent Functionality
  public function update()
{
    $model = new CommonModel();
    
    $id = $this->request->getVar('edit_id');
    $name = $this->request->getVar('name');
    $mobile = $this->request->getVar('mobile');
    $email = $this->request->getVar('email');
    $account_no = $this->request->getVar('account_no');
    $address = $this->request->getVar('address');
    $gst_no = $this->request->getVar('gst_no');
    $private = $this->request->getVar('private');
    $goverment = $this->request->getVar('goverment');
    $files = $this->request->getVar('files');
    $adharno = $this->request->getVar('editAdhar');
    $editPan = $this->request->getVar('editPan');
    $modifyBy = $_SESSION['agent_name'];

    $data['name'] = $name;
    $data['phone_no'] = $mobile;
    $data['email'] = $email;
    $data['account_no'] = $account_no;
    $data['address'] = $address;
    $data['gst_no'] = $gst_no;
    $data['PVT'] = $private;
    $data['GOVT'] = $goverment;
    $data['SEP'] = $files;
    $data['adhar_no'] = $adharno;
    $data['pan_no'] = $editPan;
    $data['modify_by'] = $modifyBy;

    // Handle image uploads
     $aadharFile = $this->request->getFile('editAdharfiles');
        if ($aadharFile && $aadharFile->isValid() && !$aadharFile->hasMoved()) {
            $aadharFileName = $aadharFile->getRandomName();
            $aadharFile->move(ROOTPATH . 'writable/uploads/Aadhar_images/', $aadharFileName);
            $data['adhar_files'] = $aadharFileName;
        }
        
        $panFile = $this->request->getFile('editpanFiles');
        if ($panFile && $panFile->isValid() && !$panFile->hasMoved()) {   
            $panFileName = $panFile->getRandomName();
            $panFile->move(ROOTPATH . 'writable/uploads/Pan_images/', $panFileName);
            $data['pan_files'] = $panFileName;
        }


    // Update the record in the database
    $this->agent->update($id, $data);

    $updateQuery = "UPDATE los_master JOIN agent_master ON agent_master.user_id = los_master.Executive
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

    $update = $model->query($updateCalculations);

    if ($update) {
        $this->session->setFlashdata('status', 'success');
        $this->session->setFlashdata('message', 'Agent Updated Successfully.');
    } else {
        $this->session->setFlashdata('status', 'error');
        $this->session->setFlashdata('message', 'Something Wrong.');
    }

    return $this->response->redirect(base_url('agentadmin/display'));
}
   
//   Agent delete functionality
   public function delete($id)
   {
       $existingRecord = $this->agent->find($id);
       
       if (!$existingRecord) {
        $this->session->setFlashdata('status', 'error');
        $this->session->setFlashdata('message', 'Record not found.');
        return $this->response->redirect(base_url('agentadmin/display'));
    }
    
       $data = $this->agent->update($id, ['status' => 0]);
    //   $data = $this->agent->where('id', $id)->delete($id);
       if ($data) {
             $this->session->setFlashdata('status', 'success');
            $this->session->setFlashdata('message', 'Agent Deleted Successfully.');
        } else {
             $this->session->setFlashdata('status', 'error');
            $this->session->setFlashdata('message', 'Something Wrong.');
        }
       return $this->response->redirect(base_url('agentadmin/display'));
       echo json_encode($data);
   }
  
  
//   Delete Subagent functionality
     public function deletesubagent($subagentId)
{
    // Check if the record exists
    $existingRecord = $this->subAgentModel->find($subagentId);

    if (!$existingRecord) {
        $this->session->setFlashdata('status', 'error');
        $this->session->setFlashdata('message', 'Record not found.');
        return $this->response->redirect(base_url('agentadmin/display'));
    }

    // Update the status to 0
    $data = $this->subAgentModel->update($subagentId, ['status' => 0]); // Assuming 'status' is the field to update

    if ($data) {
        $this->session->setFlashdata('status', 'success');
        $this->session->setFlashdata('message', 'SubAgent Deactivated Successfully.');
    } else {
        $this->session->setFlashdata('status', 'error');
        $this->session->setFlashdata('message', 'Something Went Wrong.');
    }

    return $this->response->redirect(base_url('agentadmin/display'));
}

   
    // subagent Count 
    public function getSubAgentCount()
    {
        $id = $this->request->getVar('agent_id');
        $db = db_connect();
        $builder = $db->table('sub_agent');
        $builder->select('COUNT(*) as subagent_count');
        $builder->where('agent_id', $id);
        $query = $builder->get();
    
        if ($query->getNumRows() > 0) {
            $result = $query->getRow();
            $subagentCount = $result->subagent_count;
            echo json_encode(['subagent_count' => $subagentCount]);
        } else {
            echo json_encode(['subagent_count' => 0]);
        }
    }
// Display Agent List
    public function agentlistdisplay()
        {
            $data['user'] = $this->agent->findAll();
            return view('pages/agent-list', $data);
        }
    
        public function getSubAgentDetails()
        {
            $id = $this->request->getVar('agent_id');
        
            $subagents = $this->subAgentModel->where('agent_id', $id)->findAll();
            $subagentCount = count($subagents);
        
            echo json_encode(['subagent_count' => $subagentCount, 'subagents' => $subagents]);
        }
        
    public function getsubagentedit($subagent_id)
    {
        // Assuming you are using CodeIgniter's $this->request->getVar() method to get the subagent_id from the POST data
        $subagent_id = $this->request->getVar('subagent_id');
        if ($subagent_id) {
            $subagent_details = $this->subAgentModel->find($subagent_id);
            if ($subagent_details) {
                echo json_encode($subagent_details);
            } else {
                echo json_encode(array('error' => 'Subagent not found.'));
            }
        } else {
            echo json_encode(array('error' => 'Invalid request.'));
        }
    }

    public function view()
    {
        // Get the agent ID from the POST request
        $agent_id = $this->request->getVar('id');
    
        // Create an instance of the AgentModel
        $agent = new AgentModel(); // Adjust the model name if needed
    
        // Retrieve agent details from the model
        $agentDetails = $agent->getAgentDetailsById($agent_id);
    
        // Check if agent details were found
        if ($agentDetails) {
            // Create an instance of the SubAgentModel
            $subAgentModel = new SubAgentModel();
    
            // Retrieve the number of subagents for the agent
            $subAgentCount = $subAgentModel->where('agent_id', $agent_id)->countAllResults();
    
            // Retrieve the list of subagents for the agent
            $subAgents = $subAgentModel->where('agent_id', $agent_id)->findAll();
    
            // Add subagent count and list to the agent details
            $agentDetails['sub_agent_count'] = $subAgentCount;
            $agentDetails['sub_agents'] = $subAgents;
    
            // Return agent details (including subagent count and list) as JSON response
            return $this->response->setJSON($agentDetails);
        } else {
            // Agent not found, return an error
            return $this->response->setJSON(['error' => 'Agent not found'])->setStatusCode(404);
        }
    }
 }
?>