<?php

function config($key) {
    $config = [
        'DB_HOST'       => isset($_SERVER['DB_HOST']) ? $_SERVER['DB_HOST'] : 'localhost',
        'DB_PORT'       => isset($_SERVER['DB_PORT']) ? $_SERVER['DB_PORT'] : '3306',
        'DB_DATABASE'   => isset($_SERVER['DB_DATABASE']) ? $_SERVER['DB_DATABASE'] : 'my_meetic',
        'DB_USERNAME'   => isset($_SERVER['DB_USERNAME']) ? $_SERVER['DB_USERNAME'] : 'root',
        'DB_PASSWORD'   => isset($_SERVER['DB_PASSWORD']) ? $_SERVER['DB_PASSWORD'] : '',

        'CITIES'        => [
            'paris',
            'bordeaux',
        ],

        'AGE_RANGES'    => [
            '18/25',
            '25/35',
            '35/45',
            '45/+',
        ],
    ];

    return isset($config[$key]) ? $config[$key] : NULL;
}
