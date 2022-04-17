<?php

use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use yii\log\FileTarget;

return ArrayHelper::merge(
    [
        'vendorPath' => Yii::getAlias('@vendor'),
        'bootstrap' => ['log'],
        'components' => [
            'log' => [
                'targets' => [
                    'main' => [
                        'class' => FileTarget::class,
                        'categories' => ['application'],
                        'logVars' => [],
                        'logFile' => '@logs/main.log',
                        'enableRotation' => false,
                        'prefix' => fn () => ''
                    ]
                ],
            ],
            'cache' => FileCache::class
        ],
        'params' => require 'params.php',
    ],
    file_exists(Yii::getAlias('@common/config/main-local.php')) ? require Yii::getAlias('@common/config/main-local.php') : []
);
