<?php

declare(strict_types=1);
return [
    // nacos server url like https://nacos.hyperf.io, Priority is higher than host:port
    'uri' => env('NACOS_URI','http://127.0.0.1:8848'),
    'host' => env('NACOS_HOST', '127.0.0.1'),
    'port' => (int) env('NACOS_PORT', 8848),
    'username' => env('NACOS_USERNAME'),
    'password' => env('NACOS_USERNAME'),
    'guzzle' => [
        'config' => null,
    ],
];
