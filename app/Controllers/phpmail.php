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


class phpmail extends Controller
{
    public function __construct()
    {
        helper(['url', 'form']);
        
    }
    //  public function subagents()
    // {   
    //     $data['pageTitle']='Manage Sub Agents';
    //     return view('pages/manage-subagents',$data);
    // }
    public function index()
    {
        $data['pageTitle']='mailtest';
        return view('pages/mailtest');
    }
    
    public function submitForm()
    {
        $agentName = $this->request->getPost('name');
        $agentEmail = $this->request->getPost('aemail');

        // Perform data validation and sanitization here

        // Load the email library
        $email = \Config\Services::email();

        // Set email content
        $email->setFrom('anita.glansa@gmail.com', 'anita');
        $email->setTo($agentEmail);
        $email->setSubject('Welcome as an Agent');
        $email->setMessage('Dear ' . $agentName . ', welcome as our agent!');

        // Send the email
        if ($email->send()) {
            echo 'Email sent successfully.';
        } else {
            echo 'Email could not be sent. Error: ' . $email->printDebugger(['headers']);
        }
    }
    //     $email = \Config\Services::email();

    //     $email->setFrom('anita.glansa@gmail.com', 'Anita');
    //     $email->setTo('anitaseth1997@gmail.com');
    //     // $email->setCC('another@another-example.com');
    //     // $email->setBCC('them@their-example.com');
        
    //     $email->setSubject('Email Test');
    //     $email->setMessage('Testing the email class.');
        
    //     if($email->send()){
    //         echo "success";
            
    //     }
    //     else
    //     {
    //         "invalid";
    //     }
    // }

}