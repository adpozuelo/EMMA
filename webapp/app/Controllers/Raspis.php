<?php

namespace App\Controllers;

use App\Models\RaspisModel;

class Raspis extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $model = new RaspisModel();
        $data['raspis'] = $model->getRaspis();
        $data_header = [
            'title' => 'Listado de raspberries',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Raspberries']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('raspis/list', $data);
        echo view('templates/users_footer', $data);
    }

    public function delete($name)
    {
        $session = session();
        $model = new RaspisModel();
        $model->delete_raspi($name);
        return redirect()->to(site_url('raspis'));
    }

    public function modify($name)
    {
        $session = session();
        helper(['form']);
        $data_header = [
            'title' => 'Modificar raspberry: '.$name,
            'css_header' => base_url('css/dashboard.css'),
        ];
        if ($this->request->getMethod() === 'post') {
            if ($this->validate('modify_raspi_rules')) {
                $model = new RaspisModel();
                $model->modify_raspi(
                    $this->request->getPost('name'),
                    $this->request->getPost('location'),
                    $this->request->getPost('ip_address'),
                );
                return redirect()->to(site_url('raspis'));
            } else {
                $model = new RaspisModel();
                $data['raspi'] = $model->getRaspi($name);
                $data['validation'] = $this->validator;
                $data_left_menu = left_menu_items();
                $data_left_menu['main']['Raspberries']['active'] = 'active';
                echo view('templates/header', $data_header);
                echo view('templates/dashboard_top_bar');
                echo view('templates/left_menu', $data_left_menu);
                echo view('raspis/modify', $data);
                echo view('templates/users_footer');
            }
        } else {
            $model = new RaspisModel();
            $data['raspi'] = $model->getRaspi($name);
            $data_left_menu = left_menu_items();
            $data_left_menu['main']['Raspberries']['active'] = 'active';
            echo view('templates/header', $data_header);
            echo view('templates/dashboard_top_bar');
            echo view('templates/left_menu', $data_left_menu);
            echo view('raspis/modify', $data);
            echo view('templates/users_footer');
        }
    }
}
