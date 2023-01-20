<?php

namespace App\Models;

use CodeIgniter\Model;

class GpusModel extends Model
{
    protected $table = 'gpu';

    public function getGpus()
    {
        return $this->db()->table($this->table)
        ->orderBy('node_id')->orderBy('gpu_id')
        ->get()->getResultArray();
    }


    public function getNodeGpus($node)
    {
        return $this->db()->table($this->table)
        ->where('node_id', $node)
        ->orderBy('gpu_id')
        ->get()->getResultArray();
    }

    public function delete_gpu($name)
    {
        $this->db()->table($this->table)->delete(['gpu_id' => $name]);
    }

}
