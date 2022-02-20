<?php

namespace api\controllers;

use api\collectors\auth\CurrentUserCollector;
use api\forms\auth\SignupForm;
use ddruganov\Yii2ApiAuth\http\controllers\AuthController as BaseAuthController;
use ddruganov\Yii2ApiEssentials\http\actions\ApiModelAction;
use ddruganov\Yii2ApiEssentials\http\actions\CollectorAction;

final class AuthController extends BaseAuthController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['rbac']['rules'] = [
            'logout' => 'hub.authenticate',
            'current-user' => 'hub.authenticate',
        ];
        $behaviors['rbac']['exceptions'][] = 'signup';
        $behaviors['auth']['exceptions'][] = 'signup';
        return $behaviors;
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'signup' => [
                'class' => ApiModelAction::class,
                'modelClass' => SignupForm::class
            ],
            'current-user' => [
                'class' => CollectorAction::class,
                'collectorClass' => CurrentUserCollector::class
            ]
        ]);
    }
}
