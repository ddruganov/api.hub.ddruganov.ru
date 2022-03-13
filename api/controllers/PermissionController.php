<?php

namespace api\controllers;

use api\forms\permission\CreateForm;
use api\forms\permission\DeleteForm;
use api\forms\permission\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiAuth\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;

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
