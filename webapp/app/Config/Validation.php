<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $signin_rules = [
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Correo no válido',
                'valid_email' => 'Correo no válido',
            ],
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Contraseña no válida',
            ],
        ],
    ];

    public $create_user_rules = [
        'username' => [
            'rules' => 'required|min_length[4]|max_length[16]|is_unique[users.username]',
            'errors' => [
                'required' => 'Usuario requerido',
                'min_length' => 'Usuario: longitud mínima 4 caracteres',
                'max_length' => 'Usuario: longitud máxima 16 caracteres',
                'is_unique' => 'Nombre de usuario en uso',
            ],
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'required' => 'Correo electrónico requerido',
                'valid_email' => 'Correo: formato no válido',
                'is_unique' => 'Correo electrónico en uso',
            ],
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[16]',
            'errors' => [
                'required' => 'Contraseña requerida',
                'min_length' => 'Contraseña: longitud mínima 8 caracteres',
                'max_length' => 'Contraseña: longitud máxima 16 caracteres',
            ],
        ],
        'password_conf' => [
            'rules' => 'required|min_length[8]|max_length[16]|matches[password]',
            'errors' => [
                'required' => 'Contraseña requerida',
                'min_length' => 'Contraseña: longitud mínima 8 caracteres',
                'max_length' => 'Contraseña: longitud máxima 16 caracteres',
                'matches' => 'Las contraseñas no coinciden',
            ],
        ],
    ];

    public $modify_user_rules = [
        'username' => [
            'rules' => 'required|min_length[4]|max_length[16]|is_unique[users.username,id,{id}]',
            'errors' => [
                'required' => 'Usuario requerido',
                'min_length' => 'Usuario: longitud mínima 4 caracteres',
                'max_length' => 'Usuario: longitud máxima 16 caracteres',
                'is_unique' => 'Nombre de usuario en uso',
            ],
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email,id,{id}]',
            'errors' => [
                'required' => 'Correo electrónico requerido',
                'valid_email' => 'Correo: formato no válido',
                'is_unique' => 'Correo electrónico en uso',
            ],
        ],
        'password_conf' => [
            'rules' => 'matches[password]',
            'errors' => [
                'matches' => 'Las contraseñas no coinciden',
            ],
        ],
    ];

    public $modify_raspi_rules = [
        'ip_address' => [
            'rules' => 'required|valid_ip',
            'errors' => [
                'required' => 'Dirección IP requerida',
                'valid_ip' => 'Dirección IP incorrecta',
            ],
        ],
    ];

    public $modify_sensor_rules = [
        'warning_temp' => [
            'rules' => 'decimal',
            'errors' => [
                'decimal' => 'Temperatura aviso: número decimal requerido',
            ],
        ],
        'critical_temp' => [
            'rules' => 'decimal',
            'errors' => [
                'decimal' => 'Temperatura crítica: número decimal requerido',
            ],
        ],
        'warning_hum' => [
            'rules' => 'decimal',
            'errors' => [
                'decimal' => 'Humedad aviso: número decimal requerido',
            ],
        ],
        'critical_hum' => [
            'rules' => 'decimal',
            'errors' => [
                'decimal' => 'Humedad crítica: número decimal requerido',
            ],
        ],
    ];
}
