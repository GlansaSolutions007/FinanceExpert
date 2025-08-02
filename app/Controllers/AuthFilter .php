<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if (!session()->has('data')) {
            // Redirect unauthenticated users to the login page
            return redirect()->to(base_url());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // This method is empty as we only need to check before a route is executed.
    }
}
