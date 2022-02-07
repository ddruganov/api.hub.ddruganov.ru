<?php

namespace api\controllers;

use api\collectors\auth\CurrentUserCollector;
use ddruganov\Yii2ApiAuth\http\controllers\AuthController as BaseAuthController;
use ddruganov\Yii2ApiEssentials\http\actions\CollectorAction;

final class AuthController extends BaseAuthController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['rbac']['rules'] += [
            'current-user' => 'authenticate'
        ];
        return $behaviors;
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'current-user' => [
                'class' => CollectorAction::class,
                'collectorClass' => CurrentUserCollector::class
            ]
        ]);
    }
}
