<?php

namespace api\controllers;

use api\forms\permission\CreateForm;
use api\forms\permission\DeleteForm;
use api\forms\permission\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiAuth\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\actions\ApiModelAction;

final class PermissionController extends SecureApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'rbac' => [
                'class' => RbacFilter::class,
                'rules' => [
                    'create' => 'permission.create',
                    'update' => 'permission.edit',
                    'delete' => 'permission.delete',
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
