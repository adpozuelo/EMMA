<?php

namespace App\Controllers;

use App\Models\SigninModel;
use CodeIgniter\Controller;

class Signin extends Controller
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $data_header = [
            'title' => 'Acceder',
            'css_header' => base_url('css/signin.css'),
        ];
        if ($this->request->getMethod() === 'post') {
            if ($this->validate('signin_rules')) {
                $model = new SigninModel;
                $data = $model->login($this->request->getPost('email'), $this->request->getPost('password'));
                if ($data) {
                    $session->set($data);
                    return redirect()->to(site_url('dashboard'));
                } else {
                    $session->setFlashdata('login_error', '<ul><li>Acceso no válido</li></ul>');
                    return redirect()->to(site_url('signin'));
                }
            } else {
                echo view('templates/header', $data_header);
                echo view('signin', [
                    'validation' => $this->validator,
                ]);
            }
        } else {
            echo view('templates/header', $data_header);
            echo view('signin');
        }
    }
}
