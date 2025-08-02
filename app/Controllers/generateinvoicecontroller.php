<?php

namespace App\Controllers;
   
    use App\Models\Paymentmodel;
     use App\Models\CommonModel;
    use App\Models\AgentModel;
    use COdeigniter\Controller;

    class generateinvoicecontroller extends BaseController {
          
        public function __construct()
        {
            $this->model = new Paymentmodel();
             $this->commonmodel = new CommonModel();
        }


 public function AgentDetails()
            {
                $data['agents'] = $this->commonmodel->groupBy('Executive')->findAll();
                return view('pages/gen_agent_invoice', $data);
            }




    

 public function getAgentData($agentID)
{
    $agentModel = new Paymentmodel();

    // Get agent details
    $agent = $agentModel->where('agent_id', $agentID)->first();

    if ($agent) {
        // Get transaction dates for the selected agent
        $transactionDates = $agentModel->where('agent_id', $agentID)->distinct('transaction_date')->findAll();

        $response = array(
            'agent_name' => $agent['agent_name'],
            'gst_no' => $agent['gst_no'],
            'transaction_type' => $agent['transaction_type'],
            'transaction_dates' => array_column($transactionDates, 'transaction_date')
        );
    } else {
        // Agent not found, return an empty response
        $response = array(
            'agent_name' => 'Agent not found',
            'gst_no' => 'GST not found',
            'transaction_type' => 'Transaction type not found',
            'transaction_dates' => array()
        );
    }

    // Return the agent details and transaction dates as a JSON response
    return $this->response->setJSON($response);
}


public function getCommissionAmount($agentID, $transactionDate)
{
    $agentModel = new Paymentmodel();

    // Get the commission amount for the selected agent and transaction date
    $result = $agentModel->where('agent_id', $agentID)->where('transaction_date', $transactionDate)->first();

    $response = array(
        'payment_amount' => $result['payment_amount'],
        'remark' => $result['remark']
    );

    // Return the commission amount as a JSON response
    return $this->response->setJSON($response);
}





}
    
    
    
    
    ?>