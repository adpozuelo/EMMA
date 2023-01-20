<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Signout extends Controller
{
    public function index()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('home'));
    }
}
