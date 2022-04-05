<?php

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    [
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
            ],
            'maxActiveSessions' => 3
        ]
    ],
    file_exists(Yii::getAlias('@api/config/params-local.php')) ? require Yii::getAlias('@api/config/params-local.php') : []
);
