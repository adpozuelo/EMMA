<?php

namespace App\Controllers;

use App\Models\SensorsMeasurementsModel;
use App\Models\SensorsModel;
use CodeIgniter\I18n\Time;

class Sensor extends BaseController
{
    public function view($name, $mode = null)
    {
        $session = session();
        helper(['form']);
        $sensors_model = new SensorsModel();
        $sensor = $sensors_model->getSensor($name);
        $data['sensor'] = $sensor;
        $measure_model = new SensorsMeasurementsModel();
        $now = Time::createFromFormat('ymdHi', '2107300930');
        $now = new Time('now');
        if ($mode != null) {
            $temp_avg = array();
            $hum_avg = array();
            $date_days = array();
            $time_from = $now->subDays($mode);
            $time_from_str = $time_from->format('ymdHi');
            $time_from_step = $now->subDays($mode);
            $time_to_step = $now->subDays($mode - 1);
            if ($sensor['type'] == 'TH') {
                for ($i = 0; $i < $mode; $i++) {
                    $time_from_step_str = $time_from_step->format('ymdHi');
                    $time_to_step_str = $time_to_step->format('ymdHi');
                    $temp_day = $measure_model->getMeasureFromTo(
                        $name, 'temp', $time_from_step_str, $time_to_step_str);
                    $temp_day_count = count($temp_day);
                    if ($temp_day_count > 0) {
                        $temp_avg[] = array_sum($temp_day) / $temp_day_count;
                    } else {
                        $temp_avg[] = null;
                    }

                    $hum_day = $measure_model->getMeasureFromTo(
                        $name, 'hum', $time_from_step_str, $time_to_step_str);
                    $hum_day_count = count($hum_day);
                    if ($hum_day_count > 0) {
                        $hum_avg[] = array_sum($hum_day) / $hum_day_count;
                    } else {
                        $hum_avg[] = null;
                    }
                    $date_days[] = $time_from_step->format('d/m/Y');
                    $time_from_step = $time_from_step->addDays(1);
                    $time_to_step = $time_to_step->addDays(1);
                }
                $data['temperature'] = $temp_avg;
                $data['humidity'] = $hum_avg;
                $data['datetime'] = $date_days;
                $temp_items = count($data['temperature']);
                $hum_items = count($data['temperature']);
                $data['w_temperature'] = array_fill(0, $temp_items, $sensor['warning_temp']);
                $data['c_temperature'] = array_fill(0, $temp_items, $sensor['critical_temp']);
                $data['w_humidity'] = array_fill(0, $hum_items, $sensor['warning_hum']);
                $data['c_humidity'] = array_fill(0, $hum_items, $sensor['critical_hum']);
            }
        } else {
            $time_from = $now->subHours(12);
            $time_from_str = $time_from->format('ymdHi');
            if ($sensor['type'] == 'TH') {
                $temp = $measure_model->getMeasureFrom($name, 'temp', $time_from_str);
                $hum = $measure_model->getMeasureFrom($name, 'hum', $time_from_str);
                $temp_count = count($temp);
                $hum_count = count($hum);
                if ($temp_count > 0) {
                    $data['temperature'] = $temp;
                } else {
                    $data['temperature'] = array_fill(0, $temp_count, null);
                }

                if ($hum_count > 0) {
                    $data['humidity'] = $hum;
                } else {
                    $data['humidity'] = array_fill(0, $hum_count, null);;
                }

                if ($temp_count > 0 || $hum_count > 0) {
                    $dates = $measure_model->getMeasureFrom($name, 'date', $time_from_str);
                    foreach ($dates as $date) {
                        $data['datetime'][] = Time::createFromFormat('ymdHi', $date)->format('d/m/Y H:i');
                    }
                } else {
                    $data['datetime'] = [' ', 'No hay medidas. Por favor, compruebe el sensor.', ' '];
                }
                $data['w_temperature'] = array_fill(0, $temp_count, $sensor['warning_temp']);
                $data['c_temperature'] = array_fill(0, $temp_count, $sensor['critical_temp']);
                $data['w_humidity'] = array_fill(0, $hum_count, $sensor['warning_hum']);
                $data['c_humidity'] = array_fill(0, $hum_count, $sensor['critical_hum']);
            }
        }
        $data_header = [
            'title' => $name . ' desde ' . $time_from->format('d/m/Y H:i'),
            'css_header' => base_url('css/dashboard.css'),
        ];
        if ($sensor['type'] == 'TH') {
            $data_left_menu = left_menu_items();
            $data_left_menu['sensors'][$name]['active'] = 'active';
            echo view('templates/header', $data_header);
            echo view('templates/dashboard_top_bar');
            echo view('templates/left_menu', $data_left_menu);
            echo view('sensors/view', $data);
            echo view('templates/dashboard_footer', $data);
        }
    }
}
