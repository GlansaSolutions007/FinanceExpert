<?php

namespace App\Controllers;

use App\Models\StaffModel;
use CodeIgniter\Controller;

class ForgotPasswordController extends Controller
{
    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $model = new StaffModel();
        $user = $model->where('email', $email)->first();

        if (!$user) {
            return $this->response->setStatusCode(400)->setBody('Email not found.');
        }

        $password = $user['password'];

        // Send the user's existing password via email
        $emailLibrary = \Config\Services::email();

        // Set the email parameters
        $emailLibrary->setTo($email);
        $emailLibrary->setFrom('finexperts@glansadesigns.com', 'FinanceExpert');
        $emailLibrary->setSubject('Your Password Reminder');
        $emailLibrary->setMessage('Your password is: ' . $password);

        // Send the email
        if ($emailLibrary->send()) {
            return $this->response->setStatusCode(200)->setBody('Password reminder sent to your email.');
            
        } else {
            return $this->response->setStatusCode(500)->setBody('Failed to send password reminder.');
        }
    }
}
