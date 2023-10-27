<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/25
 * Time: 22:14
 */

return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'drivers' => [
        'consul' => [
            'uri' => 'http://172.17.0.8:8500',
            'token' => '',
        ],
    ]
];