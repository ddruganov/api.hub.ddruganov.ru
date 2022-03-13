<?php

namespace api\controllers;

use api\forms\user\CreateForm;
use api\forms\user\DeleteForm;
use api\forms\user\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiAuth\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;

final class UserController extends SecureApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'rbac' => [
                'class' => RbacFilter::class,
                'rules' => [
                    'create' => 'user.create',
                    'update' => 'user.edit',
                    'delete' => 'user.delete',
                ]
            ]
        ]);
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => FormAction::class,
                'formClass' => CreateForm::class
            ],
            'update' => [
                'class' => FormAction::class,
                'formClass' => UpdateForm::class
            ],
            'delete' => [
                'class' => FormAction::class,
                'formClass' => DeleteForm::class
            ],
        ];
    }
}
