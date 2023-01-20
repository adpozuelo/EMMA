<?php

namespace App\Controllers;

use App\Models\SensorsMeasurementsModel;
use App\Models\SensorsModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $sensors_model = new SensorsModel();
        $sensors = $sensors_model->getSensors();

        if ($sensors) {
            $measure_model = new SensorsMeasurementsModel();
            foreach ($sensors as $sensor) {
                if ($sensor['type'] == 'TH') {
                    $measure = $measure_model->getLastMeasure($sensor['name']);
                    if ($measure) {
                        $measure['wt_diff'] = $sensor['warning_temp'] - $measure['temp'];
                        $measure['ct_diff'] = $sensor['critical_temp'] - $measure['temp'];
                        $measure['wh_diff'] = $sensor['warning_hum'] - $measure['hum'];
                        $measure['ch_diff'] = $sensor['critical_hum'] - $measure['hum'];
                        $measure['online'] = $sensor['online'];
                        $measure['status'] = $sensor['status'];
                        $data['sensors'][] = $measure;
                    }
                }
            }
        } else {
            $data['sensors'] = [];
        }

        $data_header = [
            'title' => 'Últimas medidas',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Principal']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('dashboard/home', $data);
        echo view('templates/users_footer');
    }
}
