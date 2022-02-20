<?php

namespace api\controllers;

use api\forms\user\CreateForm;
use api\forms\user\DeleteForm;
use api\forms\user\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiAuth\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\actions\ApiModelAction;

final class UserController extends SecureApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'rbac' => [
                'class' => RbacFilter::class,
                'rules' => [
                    'create' => 'hub.user.create',
                    'update' => 'hub.user.edit',
                    'delete' => 'hub.user.delete',
                ]
            ]
        ]);
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => ApiModelAction::class,
                'modelClass' => CreateForm::class
            ],
            'update' => [
                'class' => ApiModelAction::class,
                'modelClass' => UpdateForm::class
            ],
            'delete' => [
                'class' => ApiModelAction::class,
                'modelClass' => DeleteForm::class
            ],
        ];
    }
}
