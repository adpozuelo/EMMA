<?php

namespace App\Models;

use CodeIgniter\Model;

class GpusMeasurementsModel extends Model
{
    protected $table = 'gpu_measure';

    public function getLastMeasure($gpu)
    {
        return $this->db()->table($this->table)
            ->where('gpu_id', $gpu)
            ->get()->getLastRow('array');
    }

    public function getMeasureFrom($gpu, $property, $time)
    {
        $data = [];
        $query = $this->db()->table($this->table)
                            ->select($property)
                            ->where('gpu_id', $gpu)
                            ->where('date >', $time)
                            ->get();
        foreach ($query->getResultArray() as $row) {
            $data []= $row[$property];
        }
        return $data;
    }
    public function getMeasureFromTo($gpu, $property, $timeFrom, $timeTo)
    {
        $data = [];
        $query = $this->db()->table($this->table)
                            ->select($property)
                            ->where('gpu_id', $gpu)
                            ->where('date >', $timeFrom)
                            ->where('date <', $timeTo)
                            ->get();
        foreach ($query->getResultArray() as $row) {
            $data []= $row[$property];
        }
        return $data;
    }
}
