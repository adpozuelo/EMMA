<?php

namespace App\Models;

use CodeIgniter\Model;

class NodesMeasurementsModel extends Model
{
    protected $table = 'node_measure';

    public function getLastMeasure($node)
    {
        return $this->db()->table($this->table)
            ->where('node_id', $node)
            ->get()->getLastRow('array');
    }

    public function getMeasureFrom($node, $property, $time)
    {
        $data = [];
        $query = $this->db()->table($this->table)
                            ->select($property)
                            ->where('node_id', $node)
                            ->where('date >', $time)
                            ->get();
        foreach ($query->getResultArray() as $row) {
            $data []= $row[$property];
        }
        return $data;
    }
    public function getMeasureFromTo($node, $property, $timeFrom, $timeTo)
    {
        $data = [];
        $query = $this->db()->table($this->table)
                            ->select($property)
                            ->where('node_id', $node)
                            ->where('date >', $timeFrom)
                            ->where('date <', $timeTo)
                            ->get();
        foreach ($query->getResultArray() as $row) {
            $data []= $row[$property];
        }
        return $data;
    }
}
