<?php

namespace api\controllers;

use api\forms\role\CreateForm;
use api\forms\role\DeleteForm;
use api\forms\role\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiAuth\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\actions\ApiModelAction;

final class RoleController extends SecureApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'rbac' => [
                'class' => RbacFilter::class,
                'rules' => [
                    'create' => 'hub.role.create',
                    'update' => 'hub.role.edit',
                    'delete' => 'hub.role.delete',
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
