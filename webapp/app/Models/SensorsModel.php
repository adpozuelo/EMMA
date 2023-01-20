<?php

namespace App\Models;

use CodeIgniter\Model;

class SensorsModel extends Model
{
    protected $table = 'sensor';

    protected $allowedFields = [
        'name',
        'raspberry_id',
        'type',
        'status',
        'online',
        'error_count',
        'warning_temp',
        'critical_temp',
        'warning_hum',
        'critical_hum',
    ];

    public function getSensors()
    {
        return $this->findAll();
    }

    public function getSensor($name)
    {
        return $this->asArray()
            ->where(['name' => $name])
            ->first();
    }

    public function modify_th_sensor(
        $name, $warning_temp, $critical_temp,
        $warning_hum, $critical_hum
    ) {
        $this->db()->table($this->table)->update([
            'warning_temp' => $warning_temp,
            'critical_temp' => $critical_temp,
            'warning_hum' => $warning_hum,
            'critical_hum' => $critical_hum],
            ['name' => $name]);
    }

    public function modify_db_sensor($name, $warning_db, $critical_db)
    {
        $this->db()->table($this->table)->update([
            'warning_db' => $warning_db,
            'critical_db' => $critical_db],
            ['name' => $name]);
    }

    public function delete_sensor($name)
    {
        $this->db()->table($this->table)->delete(['name' => $name]);
    }

    public function enable_sensor($name)
    {
        $this->db()->table($this->table)->update(['status' => 1],
            ['name' => $name]);
    }

    public function disable_sensor($name)
    {
        $this->db()->table($this->table)->update(['status' => 0],
            ['name' => $name]);
    }
}
