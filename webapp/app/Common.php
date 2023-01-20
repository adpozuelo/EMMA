<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

function left_menu_items()
{
    $db = \Config\Database::connect();
    $builder = $db->table('sensor');
    $sensors = $builder->select('name')
                        ->where('type', 'TH')
                        ->get()
                        ->getResultArray();

    if (isset($sensors)) {
        foreach ($sensors as $sensor) {
            $data['sensors'][$sensor['name']] = [
                'title' => $sensor['name'],
                'controller' => 'sensor/view/'.$sensor['name'].'/',
                'icon' => 'thermometer',
                'admin' => 0,
                'active' => '',
            ];
        }
    }

    $builder = $db->table('node');
    $nodes = $builder->select('hostname')
                        ->get()
                        ->getResultArray();

    if (isset($nodes)) {
        foreach ($nodes as $node) {
            $data['nodes'][$node['hostname']] = [
                'title' => $node['hostname'],
                'controller' => 'node/view/'.$node['hostname'].'/',
                'icon' => 'cpu',
                'admin' => 0,
                'active' => '',
            ];
        }
    }

    $data['main'] = [
        'Principal' => [
            'title' => 'Principal',
            'controller' => 'dashboard',
            'icon' => 'home',
            'admin' => 0,
            'active' => '',
        ],
        'Alarmas' => [
            'title' => 'Alarmas',
            'controller' => 'alarms',
            'icon' => 'alert-triangle',
            'admin' => 0,
            'active' => '',
        ],
        'Usuarios' => [
            'title' => 'Usuarios',
            'controller' => 'users',
            'icon' => 'users',
            'admin' => 1,
            'active' => '',
        ],
        'Raspberries' => [
            'title' => 'Raspberries',
            'controller' => 'raspis',
            'icon' => 'tablet',
            'admin' => 1,
            'active' => '',
        ],
        'Sensores' => [
            'title' => 'Sensores',
            'controller' => 'sensors',
            'icon' => 'droplet',
            'admin' => 1,
            'active' => '',
        ],
        'Nodos' => [
            'title' => 'Nodos',
            'controller' => 'nodes',
            'icon' => 'server',
            'admin' => 1,
            'active' => '',
        ],
        'Gpus' => [
            'title' => 'Gpus',
            'controller' => 'gpus',
            'icon' => 'cpu',
            'admin' => 1,
            'active' => '',
        ],
    ];

    return $data;
}
