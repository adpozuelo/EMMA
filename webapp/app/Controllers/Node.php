<?php

namespace App\Controllers;

use App\Models\NodesModel;
use App\Models\NodesMeasurementsModel;
use App\Models\GpusModel;
use App\Models\GpusMeasurementsModel;
use CodeIgniter\I18n\Time;

class Node extends BaseController
{
    public function view($name, $mode = null)
    {
        $session = session();
        helper(['form']);
        $nodes_model = new NodesModel();
        $node = $nodes_model->getNode($name);
        $data['node'] = $node;
        $measure_model = new NodesMeasurementsModel();
        $data['last_measure'] = $measure_model->getLastMeasure($name);
        $data['memory'] = [$data['last_measure']['mem_used'],$data['last_measure']['mem_avail']];
        $data['fs_usage'] = [$data['last_measure']['disk_usage_fs'],100-$data['last_measure']['disk_usage_fs']];
        $data['var_usage'] = [$data['last_measure']['disk_usage_var'],100-$data['last_measure']['disk_usage_var']];
        $data['scratch_usage'] = [$data['last_measure']['disk_usage_scratch'],100-$data['last_measure']['disk_usage_scratch']];
        if ($node['n_gpu'] > 0) {
            $gpu_model = new GpusModel();
            $data['gpus'] = $gpu_model->getNodeGpus($name);
            $gpu_measure_model = new GpusMeasurementsModel();
        }
        $now = new Time('now');
        if ($mode != null) {
            $time_from = $now->subDays($mode);
            $time_from_str = $time_from->format('ymdHi');
            $time_from_step = $now->subDays($mode);
            $time_to_step = $now->subDays($mode - 1);
            if ($node['n_gpu'] > 0) {
                foreach ($data['gpus'] as $gpu) {
                    $gpu_last_measure = $gpu_measure_model->getLastMeasure($gpu['gpu_id']);
                    $data['gpu_memory'] []= [$gpu_last_measure['mem_used'],$gpu_last_measure['mem_avail']];
                }
            }
            for ($i = 0; $i < $mode; $i++) {
                $time_from_step_str = $time_from_step->format('ymdHi');
                $time_to_step_str = $time_to_step->format('ymdHi');
                $load_day = $measure_model->getMeasureFromTo(
                    $name, 'load_15', $time_from_step_str, $time_to_step_str);
                $load_day_count = count($load_day);
                if ($load_day_count > 0) {
                    $load_avg[] = array_sum($load_day) / $load_day_count;
                } else {
                    $load_avg[] = null;
                }
                if ($node['n_gpu'] > 0) {
                    foreach ($data['gpus'] as $gpu) {
                        $gpu_load_day = $gpu_measure_model->getMeasureFromTo(
                            $gpu['gpu_id'], 'gpu_load', $time_from_step_str, $time_to_step_str);
                        $load_gpu_count = count($gpu_load_day);
                        if ($load_gpu_count > 0) {
                            $gpu_load_avg[$gpu['gpu_id']] []= array_sum($gpu_load_day) / $load_gpu_count;
                        } else {
                            $gpu_load_avg[$gpu['gpu_id']] []= null;
                        }
                    }
                }
                $date_days[] = $time_from_step->format('d/m/Y');
                $time_from_step = $time_from_step->addDays(1);
                $time_to_step = $time_to_step->addDays(1);
            }
            if ($node['n_gpu'] > 0) {
                foreach ($data['gpus'] as $gpu) {
                    $data['gpus_load'] []= $gpu_load_avg[$gpu['gpu_id']];
                }
            }
            $data['load'] = $load_avg;
            $data['datetime'] = $date_days;
        } else {
            $time_from = $now->subHours(24);
            $time_from_str = $time_from->format('ymdHi');
            $load = $measure_model->getMeasureFrom($name, 'load_15', $time_from_str);
            $load_count = count($load);
            if ($load_count > 0) {
                $data['load'] = $load;
            } else {
                $data['load'] = array_fill(0, $load_count, null);
            }
            if ($node['n_gpu'] > 0) {
                foreach ($data['gpus'] as $gpu) {
                    $gpu_last_measure = $gpu_measure_model->getLastMeasure($gpu['gpu_id']);
                    $data['gpu_memory'] []= [$gpu_last_measure['mem_used'],$gpu_last_measure['mem_avail']];
                    $load_gpu = $gpu_measure_model->getMeasureFrom($gpu['gpu_id'], 'gpu_load', $time_from_str);
                    $load_gpu_count = count($load_gpu);
                    if ($load_gpu_count > 0) {
                        $data['gpus_load'] []= $load_gpu;
                    } else {
                        $data['gpus_load'] []= array_fill(0, $load_gpu_count, null);
                    }
                }
            }
            if ($load_count > 0) {
                $dates = $measure_model->getMeasureFrom($name, 'date', $time_from_str);
                foreach ($dates as $date) {
                    $data['datetime'][] = Time::createFromFormat('ymdHi', $date)->format('d/m/Y H:i');
                }
            } else {
                $data['datetime'] = [' ', 'No hay medidas. Por favor, compruebe el nodo.', ' '];
            }
        }
        $data_header = [
            'title' => $name . ' desde ' . $time_from->format('d/m/Y H:i'),
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['nodes'][$name]['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('nodes/view', $data);
        echo view('templates/node_measure_footer', $data);
    }
}
