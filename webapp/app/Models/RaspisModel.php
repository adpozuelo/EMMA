<?php

namespace App\Models;

use CodeIgniter\Model;

class RaspisModel extends Model
{
    protected $table = 'raspberry';

    protected $allowedFields = [
        'hostname',
        'ip_address',
        'location',
    ];

    public function getRaspis()
    {
        return $this->findAll();
    }

    public function getRaspi($name)
    {
        return $this->asArray()
            ->where(['hostname' => $name])
            ->first();
    }

    public function modify_raspi($name, $location, $ip_address)
    {
        $this->db()->table($this->table)->update(['location' => $location,
            'ip_address' => $ip_address],
            ['hostname' => $name]);
    }

    public function delete_raspi($name)
    {
        $this->db()->table($this->table)->delete(['hostname' => $name]);
    }
}
