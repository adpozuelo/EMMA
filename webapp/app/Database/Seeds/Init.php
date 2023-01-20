<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{
    public function run()
    {
        $username = 'adminuser';
        $plain_password = 'adminpassword';
        $email = 'admin@yourdomain.com';

        $table = 'users';

        $fields = [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'group' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default' => 'user',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['enabled', 'disabled'],
                'default' => 'enabled',
            ],
        ];

        $password = password_hash($plain_password, PASSWORD_BCRYPT);

        $data = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'group' => 'admin',
        ];

        $this->forge->addField('id');
        $this->forge->addField($fields);
        $this->forge->createTable($table, true);
        $this->db->table($table)->insert($data);
    }
}
