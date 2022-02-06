<?php

use yii\db\Connection;
use yii\log\FileTarget;

return [
    'vendorPath' => Yii::getAlias('@vendor'),
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'categories' => ['application'],
                    'logVars' => [],
                    'logFile' => '@logs/main.log',
                    'enableRotation' => false,
                    'prefix' => fn () => ''
                ]
            ],
        ],
        'db' => [
            'class' => Connection::class,
            'dsn' => 'pgsql:host=yii2-api-template-db;dbname=pgdb',
            'username' => 'pguser',
            'password' => 'pgpass',
            'charset' => 'utf8',
            'enableSchemaCache' => false,
        ],
    ],
    'params' => require 'params.php',
];
