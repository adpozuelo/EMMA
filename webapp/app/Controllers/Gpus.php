<?php

namespace App\Controllers;

use App\Models\GpusModel;

class Gpus extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $model = new GpusModel();
        $data['gpus'] = $model->getGpus();
        $data_header = [
            'title' => 'Listado de Gpus',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Gpus']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('gpus/list', $data);
        echo view('templates/users_footer', $data);
    }

    public function delete($name)
    {
        $session = session();
        $model = new GpusModel();
        $model->delete_gpu($name);
        return redirect()->to(site_url('gpus'));
    }

}
