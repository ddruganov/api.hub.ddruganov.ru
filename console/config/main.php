<?php

use yii\console\controllers\MigrateController;
use yii\helpers\ArrayHelper;

$commonConfig = require Yii::getAlias('@common/config/main.php');

return ArrayHelper::merge($commonConfig, [
    'id' => 'app-console',
    'basePath' => Yii::getAlias('@console'),
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'migrate' => [
            'class' => MigrateController::class,
            'migrationPath' => null,
            'migrationNamespaces' => [
                'console\migrations',
                'ddruganov\Yii2ApiAuth\migrations',
            ],
        ],
    ],
    'params' => require 'params.php',
]);
