<?php

namespace App\Models;

use CodeIgniter\Model;

class AgentModel extends Model
{
    
    protected $table            = 'agent_master';
    protected $primaryKey       = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id','user_id','name','phone_no','email','account_no','PVT','GOVT','SEP','address','adhar_files','adhar_no','pan_files','pan_no','gst_no','created_on','created_by','modify_on','modify_by','status'];

    // Dates
    public function getCountOfAgents()
{
    $lastAgent = AgentModel::where('status', 1)->orderBy('id', 'desc')->first();
    
    return [
        'lastAgent' => $lastAgent,
        'totalAgents' => $this->where('status', 1)->countAllResults(),
    ];
}

    public function checkEmailExistence($email)
{
    try {
        $query = $this->where('email', $email)->get();

        if ($query->getResult()) {
            return count($query->getResult()) > 0;
        } else {
            // Handle query error
            log_message('error', 'Database query error: ' . $this->db->getLastQuery());
            return false;
        }
    } catch (\Exception $e) {
        // Handle other exceptions
        log_message('error', 'Exception: ' . $e->getMessage());
        return false;
    }
}

    public function getAgentEmails($agentId)
{
    // Assuming you have a database table for agents
    // Replace 'agents' with your actual table name
 
    $query = $this->where('id', $agentId)->findAll();

       return $query;

}
    
     public function getAgentEmail($agentId)
    {
        $agent = $this->find($agentId); // Retrieve the agent based on their user_id

        if ($agent) {
            return $agent['email']; // Return the agent's email
        } else {
            return null; // Handle the case where the agent is not found.
        }
    }
   
   public function getPayoutPercentage($agentId, $category) {
    $this->db->select($category); // Select the appropriate column based on the category
    $this->db->where('agent_id', $agentId);
    $query = $this->db->get('agent_master'); // Replace 'agent_table' with your actual table name

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->$category; // Assuming the payout percentage column matches the category name
    } else {
        return 0; // Default value if no matching record is found
    }
}

 public function getAgentDetailsById($agent_id)
    {
        // Query the database to retrieve agent details by ID
        return $this->where('id', $agent_id)->first();
    }
    
    public function getAgentNameById($agentId) 
    {
       // Fetch and return the agent name based on the provided agent ID
      return $this->select('agent_name') // Assuming 'agent_name' is the column name for the agent name
                ->where('user_id', $agentId)
                ->get()
                ->getRowArray();
    }


    public function getDataToExport()
{
    try {
        // Modify this query as needed to select the specific data you want to export
        $query = $this->select('name, phone_no, email, address, adhar_no, adhar_files, pan_no, pan_files')
            ->findAll(); // You can add conditions, sorting, etc., as needed

        // Check if any data was found
        if (!empty($query)) {
            return $query;
        } else {
            return []; // Return an empty array if no data is found
        }
    } catch (\Exception $e) {
        // Handle any database or query errors here
        // You can log the error or return an appropriate response
        return []; // Return an empty array or handle the error as needed
    }
}

}
    