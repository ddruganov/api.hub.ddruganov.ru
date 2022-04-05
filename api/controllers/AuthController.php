<?php

namespace api\controllers;

use api\collectors\auth\CurrentUserCollector;
use api\forms\auth\SignupForm;
use ddruganov\Yii2ApiAuth\http\controllers\AuthController as BaseAuthController;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;
use yii\helpers\ArrayHelper;

final class AuthController extends BaseAuthController
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'auth' => [
                    'exceptions' => ['signup']
                ],
                'rbac' => [
                    'rules' => ['current-user' => 'authenticate'],
                    'exceptions' => ['signup']
                ]
            ]
        );
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'signup' => [
                'class' => FormAction::class,
                'formClass' => SignupForm::class
            ],
            'current-user' => [
                'class' => FormAction::class,
                'formClass' => CurrentUserCollector::class
            ]
        ]);
    }
}
