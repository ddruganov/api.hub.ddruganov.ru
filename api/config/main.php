<?php

use api\components\RbacComponent;
use ddruganov\Yii2ApiAuth\components\AuthComponent;
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
            'enableStrictParsing' => true,
            'rules' => require 'routes.php'
        ],
        'auth' => AuthComponent::class,
        'rbac' => RbacComponent::class
    ],
    'params' => require 'params.php',
]);
