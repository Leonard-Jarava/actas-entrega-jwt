<?php

$rutas = [
    'asistencias' => [
        'controlador' => 'asistenciaControlador',
        'acciones' => [
            'crear' =>  [
                'metodoHttp' => 'POST',
                'autenticacion' => true,
            ],
            'leer' => [
                'metodoHttp' => 'GET',
                'autenticacion' => true,
            ],
            'eliminar' => [
                'metodoHttp' => 'DELETE',
                'autenticacion' => true,
            ]
        ]
    ],
    'reuniones' => [
        'controlador' => 'reunionControlador',
        'acciones' => [
            'crear' => [
                'metodoHttp' => 'POST',
                'autenticacion' => true,
            ],
            'leer' => [
                'metodoHttp' => 'GET',
                'autenticacion' => true,
            ],
            'actualizar' => [
                'metodoHttp' => 'PUT',
                'autenticacion' => true,
            ],
            'eliminar' => [
                'metodoHttp' => 'DELETE',
                'autenticacion' => true,
            ]
        ]
    ],
    'actas' => [
        'controlador' => 'actaControlador',
        'acciones' => [
            'crear' => [
                'metodoHttp' => 'POST',
                'autenticacion' => true,
            ],
            'leer' => [
                'metodoHttp' => 'GET',
                'autenticacion' => true,
            ],
            'actualizar' => [
                'metodoHttp' => 'PUT',
                'autenticacion' => true,
            ],
            'eliminar' => [
                'metodoHttp' => 'DELETE',
                'autenticacion' => true,
            ]
        ]
    ],
    'usuarios' => [
        'controlador' => 'usuarioControlador',
        'acciones' => [
            'crear' => [
                'metodoHttp' => 'POST',
                'autenticacion' => true,
            ],
            'leer' => [
                'metodoHttp' => 'GET',
                'autenticacion' => true,
            ],
            'actualizar' => [
                'metodoHttp' => 'PUT',
                'autenticacion' => true,
            ],
            'eliminar' => [
                'metodoHttp' => 'DELETE',
                'autenticacion' => true,
            ]
        ]
    ],
    'autenticacion' => [
        'controlador' => 'autenticacionControlador',
        'acciones' => [
            'login' => [
                'metodoHttp' => 'POST',
                'autenticacion' => false,
            ],
            'refresh' => [
                'metodoHttp' => 'POST',
                'autenticacion' => false,
            ],
            'logout' => [
                'metodoHttp' => 'POST',
                'autenticacion' => true,
            ]
        ]
    ]
];
