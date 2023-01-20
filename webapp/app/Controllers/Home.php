<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $data_header = [
            'title' => 'EMMA',
            'css_header' => base_url('css/cover.css'),
        ];
        echo view('templates/header', $data_header);
        echo view('home');
    }
}
