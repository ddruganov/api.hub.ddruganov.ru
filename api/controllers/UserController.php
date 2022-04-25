<?php

namespace api\controllers;

use api\collectors\user\UserAllCollector;
use api\collectors\user\UserOneCollector;
use api\forms\user\CreateForm;
use api\forms\user\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\UserController as BaseUserController;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;

final class UserController extends BaseUserController
{
    public function actions()
    {
        return [
            'all' => [
                'class' => FormAction::class,
                'formClass' => UserAllCollector::class
            ],
            'one' => [
                'class' => FormAction::class,
                'formClass' => UserOneCollector::class
            ],
            'create' => [
                'class' => FormAction::class,
                'formClass' => CreateForm::class
            ],
            'update' => [
                'class' => FormAction::class,
                'formClass' => UpdateForm::class
            ]
        ];
    }
}
