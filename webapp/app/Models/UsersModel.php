<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = [
                            'username',
                            'email',
                            'group',
                            'password',
                            'status',
                            ];

    public function getUsers()
    {
        return $this->select('id, username, email, group, status')
                    ->findAll();
    }

    public function getUser($id)
    {
        return $this->asArray()
                    ->select('id, username, email, group')
                    ->where(['id' => $id])
                    ->first();
    }

    public function enable_user($id) {
        $this->db()->table($this->table)->update(['status' => 'enabled'],
                                                ['id' => $id]);
    }

    public function disable_user($id) {
        $this->db()->table($this->table)->update(['status' => 'disabled'],
                                                ['id' => $id]);
    }

    public function delete_user($id) {
        $this->delete(['id' => $id]);
    }
}
