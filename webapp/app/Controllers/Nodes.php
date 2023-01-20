<?php

namespace App\Controllers;

use App\Models\NodesModel;

class Nodes extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $model = new NodesModel();
        $data['n_cpus'] = 0;
        $data['n_gpus'] = 0;
        $data['nodes'] = $model->getNodes();
        foreach ($data['nodes'] as $node) {
            $data['n_cpus'] += $node['n_cpu'];
            $data['n_gpus'] += $node['n_gpu'];
        }
        $data_header = [
            'title' => 'Listado de nodos',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Nodos']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('nodes/list', $data);
        echo view('templates/users_footer', $data);
    }

    public function delete($name)
    {
        $session = session();
        $model = new NodesModel();
        $model->delete_node($name);
        return redirect()->to(site_url('nodes'));
    }
}
