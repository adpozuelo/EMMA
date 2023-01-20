<?php

namespace App\Controllers;

use App\Models\SensorsModel;

class Sensors extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $model = new SensorsModel();
        $data['sensors'] = $model->getSensors();
        $data_header = [
            'title' => 'Listado de sensores',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Sensores']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('sensors/list', $data);
        echo view('templates/users_footer', $data);
    }

    public function enable($name)
    {
        $session = session();
        $model = new SensorsModel();
        $model->enable_sensor($name);
        return redirect()->to(site_url('sensors'));
    }

    public function disable($name)
    {
        $session = session();
        $model = new SensorsModel();
        $model->disable_sensor($name);
        return redirect()->to(site_url('sensors'));
    }

    public function delete($name)
    {
        $session = session();
        $model = new SensorsModel();
        $model->delete_sensor($name);
        return redirect()->to(site_url('sensors'));
    }

    public function modify($name)
    {
        $session = session();
        helper(['form']);
        $data_header = [
            'title' => 'Modificar sensor: ' . $name,
            'css_header' => base_url('css/dashboard.css'),
        ];
        if ($this->request->getMethod() === 'post') {
            if ($this->validate('modify_sensor_rules')) {
                $model = new SensorsModel();
                if ($this->request->getPost('type') == 'TH') {
                    $model->modify_th_sensor(
                        $this->request->getPost('name'),
                        $this->request->getPost('warning_temp'),
                        $this->request->getPost('critical_temp'),
                        $this->request->getPost('warning_hum'),
                        $this->request->getPost('critical_hum'),
                    );
                } else if ($this->request->getPost('type') == 'DB') {
                    $model->modify_db_sensor(
                        $this->request->getPost('name'),
                        $this->request->getPost('warning_db'),
                        $this->request->getPost('critical_db'),
                    );
                }
                return redirect()->to(site_url('sensors'));
            } else {
                $model = new SensorsModel();
                $data['sensor'] = $model->getSensor($name);
                $data['validation'] = $this->validator;
                $data_left_menu = left_menu_items();
                $data_left_menu['main']['Sensores']['active'] = 'active';
                echo view('templates/header', $data_header);
                echo view('templates/dashboard_top_bar');
                echo view('templates/left_menu', $data_left_menu);
                echo view('sensors/modify', $data);
                echo view('templates/users_footer');
            }
        } else {
            $model = new SensorsModel();
            $data['sensor'] = $model->getSensor($name);
            $data_left_menu = left_menu_items();
            $data_left_menu['main']['Sensores']['active'] = 'active';
            echo view('templates/header', $data_header);
            echo view('templates/dashboard_top_bar');
            echo view('templates/left_menu', $data_left_menu);
            echo view('sensors/modify', $data);
            echo view('templates/users_footer');
        }
    }
}
