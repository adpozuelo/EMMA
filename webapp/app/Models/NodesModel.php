<?php

namespace App\Models;

use CodeIgniter\Model;

class NodesModel extends Model
{
    protected $table = 'node';

    public function getNodes()
    {
        return $this->findAll();
    }

    public function getNode($name)
    {
        return $this->asArray()
            ->where(['hostname' => $name])
            ->first();
    }

    public function delete_node($name)
    {
        $this->db()->table($this->table)->delete(['hostname' => $name]);
    }
}
