<?php

namespace App\Models;

use CodeIgniter\Model;

class AlarmsModel extends Model
{
    protected $table = 'alarm';

    public function getAlarms()
    {
        return $this->db()->table($this->table)
        ->limit(20)->orderBy('id', 'DESC')
        ->get()->getResultArray();
    }

    public function delete_alarm($id) {
        $this->delete(['id' => $id]);
    }
}
