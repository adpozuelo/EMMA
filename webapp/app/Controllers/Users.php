<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $session = session();
        helper(['form']);
        $model = new UsersModel();
        $data['users'] = $model->getUsers();
        $data_header = [
            'title' => 'Listado de usuarios',
            'css_header' => base_url('css/dashboard.css'),
        ];
        $data_left_menu = left_menu_items();
        $data_left_menu['main']['Usuarios']['active'] = 'active';
        echo view('templates/header', $data_header);
        echo view('templates/dashboard_top_bar');
        echo view('templates/left_menu', $data_left_menu);
        echo view('users/list', $data);
        echo view('templates/users_footer', $data);
    }

    public function enable($id)
    {
        $session = session();
        $model = new UsersModel();
        $model->enable_user($id);
        return redirect()->to(site_url('users'));
    }

    public function disable($id)
    {
        $session = session();
        $model = new UsersModel();
        $model->disable_user($id);
        return redirect()->to(site_url('users'));
    }

    public function delete($id)
    {
        $session = session();
        $model = new UsersModel();
        $model->delete_user($id);
        return redirect()->to(site_url('users'));
    }

    public function create()
    {
        $session = session();
        helper(['form']);
        $data_header = [
            'title' => 'Crear usuario',
            'css_header' => base_url('css/dashboard.css'),
        ];
        if ($this->request->getMethod() === 'post') {
            if ($this->validate('create_user_rules')) {
                $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
                $model = new UsersModel();
                $model->save([
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => $password,
                    'group' => $this->request->getPost('group'),
                ]);
                return redirect()->to(site_url('users'));
            } else {
                $data_left_menu = left_menu_items();
                $data_left_menu['main']['Usuarios']['active'] = 'active';
                echo view('templates/header', $data_header);
                echo view('templates/dashboard_top_bar');
                echo view('templates/left_menu', $data_left_menu);
                echo view('users/create', [
                    'validation' => $this->validator,
                ]);
                echo view('templates/users_footer');
            }
        } else {
            $data_left_menu = left_menu_items();
            $data_left_menu['main']['Usuarios']['active'] = 'active';
            echo view('templates/header', $data_header);
            echo view('templates/dashboard_top_bar');
            echo view('templates/left_menu', $data_left_menu);
            echo view('users/create');
            echo view('templates/users_footer');
        }
    }

    public function modify($id)
    {
        $session = session();
        helper(['form']);
        $data_header = [
            'title' => 'Modificar usuario',
            'css_header' => base_url('css/dashboard.css'),
        ];
        if ($this->request->getMethod() === 'post') {
            if ($this->validate('modify_user_rules')) {
                $data = [
                    'id' => $this->request->getPost('id'),
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'group' => $this->request->getPost('group'),
                ];
                if ($this->request->getPost('password')) {
                    $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
                    $data['password'] = $password;
                }
                $model = new UsersModel();
                $model->save($data);
                return redirect()->to(site_url('users'));
            } else {
                $model = new UsersModel();
                $data['user'] = $model->getUser($id);
                $data['validation'] = $this->validator;
                $data_left_menu = left_menu_items();
                $data_left_menu['main']['Usuarios']['active'] = 'active';
                echo view('templates/header', $data_header);
                echo view('templates/dashboard_top_bar');
                echo view('templates/left_menu', $data_left_menu);
                echo view('users/modify', $data);
                echo view('templates/users_footer');
            }
        } else {
            $model = new UsersModel();
            $data['user'] = $model->getUser($id);
            $data_left_menu = left_menu_items();
            $data_left_menu['main']['Usuarios']['active'] = 'active';
            echo view('templates/header', $data_header);
            echo view('templates/dashboard_top_bar');
            echo view('templates/left_menu', $data_left_menu);
            echo view('users/modify', $data);
            echo view('templates/users_footer');
        }
    }
}
