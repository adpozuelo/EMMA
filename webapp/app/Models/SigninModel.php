<?php

namespace App\Models;

use CodeIgniter\Model;

class SigninModel extends Model
{
    protected $table = 'users';

    public function login($email, $password)
    {
        $db_data = $this->asArray()->where(['email' => $email])->first();
        if ($db_data && password_verify($password, $db_data['password'])) {
            if ($db_data['status'] === 'enabled') {
                return array(
                    'username' => $db_data['username'],
                    'email' => $db_data['email'],
                    'group' => $db_data['group'],
                    'logged' => true,
                );
            }
        }
        return array();
    }
}
