<?php

namespace App\Models;

use CodeIgniter\Model;

class SensorsMeasurementsModel extends Model
{
    protected $table = 'sensor_measure';

    public function getLastMeasure($sensor)
    {
        return $this->db()->table($this->table)
            ->where('sensor_id', $sensor)
            ->get()->getLastRow('array');
    }

    public function getMeasureFrom($sensor, $property, $time)
    {
        $data = [];
        $query = $this->db()->table($this->table)
                            ->select($property)
                            ->where('sensor_id', $sensor)
                            ->where('date >', $time)
                            ->get();
        foreach ($query->getResultArray() as $row) {
            $data []= $row[$property];
        }
        return $data;
    }
    public function getMeasureFromTo($sensor, $property, $timeFrom, $timeTo)
    {
        $data = [];
        $query = $this->db()->table($this->table)
                            ->select($property)
                            ->where('sensor_id', $sensor)
                            ->where('date >', $timeFrom)
                            ->where('date <', $timeTo)
                            ->get();
        foreach ($query->getResultArray() as $row) {
            $data []= $row[$property];
        }
        return $data;
    }
}
