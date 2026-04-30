<?php

return [
    'defaults' => [
        'guard'     => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],
        'family' => [
            'driver'   => 'session',
            'provider' => 'families',
        ],
        'educator' => [
            'driver'   => 'session',
            'provider' => 'educators',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],
        'families' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Family::class,
        ],
        'educators' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Educator::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];