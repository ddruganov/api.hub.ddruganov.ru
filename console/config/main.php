<?php

use yii\console\controllers\MigrateController;
use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require Yii::getAlias('@common/config/main.php'),
    [
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
    ],
    file_exists(Yii::getAlias('@console/config/main-local.php')) ? require Yii::getAlias('@console/config/main-local.php') : []
);
