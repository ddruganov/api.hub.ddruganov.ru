<?php

use yii\helpers\ArrayHelper;

$localParams = require 'params-local.php';

return ArrayHelper::merge([
    'authentication' => [
        'masterPassword' => [
            'enabled' => false,
            'value' => ''
        ],
        'tokens' => [
            'secret' => '',
            'access' => [
                'ttl' => 60 * 60, // seconds
                'issuer' => 'localhost',
            ],
            'refresh' => [
                'ttl' => 60 * 60 * 24 * 30 // seconds
            ]
        ]
    ]
], $localParams);
