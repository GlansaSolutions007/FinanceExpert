<?php

namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\AgentModel;
    use App\Models\StaffModel;
    use App\Models\Paymentmodel;
    use App\Models\EmiModel;
    use App\Models\NumberofScheme;
    use COdeigniter\Controller;
    use DateTime; 


    class bankInvoice extends BaseController
    {
    public  function __construct()
    {
        
        helper(['url','form']);
        // $this->payment = new Paymentmodel();
    }
    public function display()
    {
        $this->usermodel = new UserModel();
        $this->agent = new AgentModel();
       

        $data['banks'] = $this->usermodel->findAll();
        $data['branch'] = $this->usermodel->findAll();
        $data['users'] = $this->agent->findAll();
        return view('pages/empty', $data);
    }
    
  
    // Existing code in the controller...

        public function getagent($selectedAgentId)
        {
            $data = $this->agent->where('user_id', $selectedAgentId)->first();
            echo json_encode($data);
        }
    }
    ?>