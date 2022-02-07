<?php

use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use yii\log\FileTarget;

$local = require 'main-local.php';

return ArrayHelper::merge([
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
        'cache' => FileCache::class
    ],
    'params' => require 'params.php',
], $local);
