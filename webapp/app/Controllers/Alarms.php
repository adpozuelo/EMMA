<?php

namespace App\Controllers;

use App\Models\AlarmsModel;

class Alarms extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $alarms_model = new AlarmsModel();
        $data['alarms'] = $alarms_model->getAlarms();
        $data_header = [
            'title' => 'Últimas alarmas',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Alarmas']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('dashboard/alarms', $data);
        echo view('templates/users_footer');
    }
}
