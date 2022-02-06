<?php

use ddruganov\Yii2ApiAuth\components\AuthComponent;
use ddruganov\Yii2ApiAuth\components\RbacComponent;
use ddruganov\Yii2ApiAuth\http\controllers\AuthController;
use yii\helpers\ArrayHelper;

$commonConfig = require Yii::getAlias('@common/config/main.php');

return ArrayHelper::merge($commonConfig, [
    'id' => 'app-api',
    'basePath' => Yii::getAlias('@api'),
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require 'routes.php'
        ],
        'auth' => AuthComponent::class,
        'rbac' => RbacComponent::class
    ],
    'controllerMap' => [
        'auth' => AuthController::class
    ],
    'params' => require 'params.php',
]);
