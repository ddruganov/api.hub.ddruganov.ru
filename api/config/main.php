<?php

use api\components\auth\AuthComponent;
use api\controllers\RoleController;
use ddruganov\Yii2ApiAuth\components\AccessTokenProviderInterface;
use ddruganov\Yii2ApiAuth\components\AuthComponentInterface;
use ddruganov\Yii2ApiAuth\components\HeaderAccessTokenProvider;
use ddruganov\Yii2ApiAuth\components\RbacComponent;
use ddruganov\Yii2ApiAuth\components\RbacComponentInterface;
use ddruganov\Yii2ApiAuth\http\controllers\AppController;
use ddruganov\Yii2ApiAuth\http\controllers\PermissionController;
use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require Yii::getAlias('@common/config/main.php'),
    [
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
            AuthComponentInterface::class => AuthComponent::class,
            RbacComponentInterface::class => RbacComponent::class,
            AccessTokenProviderInterface::class => HeaderAccessTokenProvider::class
        ],
        'controllerMap' => [
            'app' => AppController::class,
            'permission' => PermissionController::class,
            'role' => RoleController::class,
        ],
        'params' => require 'params.php',
    ],
    file_exists(Yii::getAlias('@api/config/main-local.php')) ? require Yii::getAlias('@api/config/main-local.php') : []
);
